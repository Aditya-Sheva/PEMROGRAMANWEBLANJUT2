<?php
namespace App\Http\Controllers;

use App\Models\Proposal;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class ProposalController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $proposals = ($user->isSecretary() || $user->isAdmin())
            ? Proposal::with('user')->latest()->paginate(10)
            : $user->proposals()->latest()->paginate(10);
        return view('proposals.index', compact('proposals'));
    }

    public function create()
    {
        return view('proposals.create');
    }

    public function downloadTemplate()
    {
        $latestTemplate = \App\Models\Template::latest()->first();
        if ($latestTemplate) {
            $extension = pathinfo($latestTemplate->file_path, PATHINFO_EXTENSION);
            $downloadName = $latestTemplate->name;
            if ($extension && !str_ends_with(strtolower($downloadName), '.'.$extension)) {
                $downloadName .= '.'.$extension;
            }
            return Storage::disk('public')->download($latestTemplate->file_path, $downloadName);
        }

        $pdf = Pdf::loadView('proposals.template-pdf')
            ->setPaper('a4', 'portrait')
            ->setOptions([
                'defaultFont'     => 'serif',
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled' => false,
                'dpi'             => 150,
            ]);

        return $pdf->download('formulir-pengajuan-ethical-clearance-SKE1.pdf');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'           => 'required|string|max:255',
            'description'     => 'nullable|string',
            'researcher_name' => 'required|string|max:255',
            'institution'     => 'nullable|string|max:255',
            'submission_date' => 'required|date',
            'proposal_file'   => 'required|file|mimes:pdf,doc,docx|max:10240',
        ]);

        $path = $request->file('proposal_file')->store('proposals','public');

        $proposal = Proposal::create([
            ...$validated,
            'user_id'       => Auth::id(),
            'proposal_file' => $path,
            'status'        => 'pending',
        ]);

        Document::create([
            'proposal_id'   => $proposal->id,
            'document_name' => $request->file('proposal_file')->getClientOriginalName(),
            'file_path'     => $path,
            'file_type'     => $request->file('proposal_file')->getMimeType(),
            'document_type' => 'proposal',
        ]);

        return redirect()->route('proposals.show', $proposal)
            ->with('success', 'Proposal berhasil diajukan!');
    }

    public function show(Proposal $proposal)
    {
        $proposal->load('user','documents','reviews.reviewer','decision.secretary','decision.chief');
        $reviewers = \App\Models\User::where('role','reviewer')->where('is_active',true)->get();
        $secretaries = \App\Models\User::where('role','sekretariat')->where('is_active',true)->get();
        $chiefs = \App\Models\User::where('role','ketua')->where('is_active',true)->get();
        return view('proposals.show', compact('proposal','reviewers','secretaries','chiefs'));
    }

    public function uploadSupporting(Request $request, Proposal $proposal)
    {
        $request->validate([
            'documents' => 'required',
            'documents.*' => 'file|mimes:pdf,doc,docx,jpg,png|max:5120',
        ]);

        $files = $request->file('documents', []);
        foreach ($files as $file) {
            $path = $file->store('supporting-docs','public');
            Document::create([
                'proposal_id'   => $proposal->id,
                'document_name' => $file->getClientOriginalName(),
                'file_path'     => $path,
                'file_type'     => $file->getMimeType(),
                'document_type' => 'supporting',
            ]);
        }
        return back()->with('success', 'Dokumen pendukung berhasil diupload!');
    }

    public function resubmit(Request $request, Proposal $proposal)
    {
        $request->validate([
            'proposal_file' => 'required|file|mimes:pdf,doc,docx|max:10240',
            'documents' => 'nullable',
            'documents.*' => 'file|mimes:pdf,doc,docx,jpg,png|max:5120',
        ]);

        $path = $request->file('proposal_file')->store('proposals','public');
        $proposal->update([
            'proposal_file' => $path,
            'status' => 'pending',
        ]);

        Document::create([
            'proposal_id'   => $proposal->id,
            'document_name' => $request->file('proposal_file')->getClientOriginalName(),
            'file_path'     => $path,
            'file_type'     => $request->file('proposal_file')->getMimeType(),
            'document_type' => 'proposal_revision',
        ]);

        $files = $request->file('documents', []);
        foreach ($files as $file) {
            $supportPath = $file->store('supporting-docs','public');
            Document::create([
                'proposal_id'   => $proposal->id,
                'document_name' => $file->getClientOriginalName(),
                'file_path'     => $supportPath,
                'file_type'     => $file->getMimeType(),
                'document_type' => 'supporting',
            ]);
        }

        return back()->with('success', 'Revisi proposal berhasil diupload dan dikirim ulang!');
    }

    public function confirmData(Request $request, Proposal $proposal)
    {
        if ($proposal->status !== 'data_confirmation') {
            return back()->with('error', 'Proposal belum pada tahap konfirmasi data.');
        }

        if ($proposal->user_id !== Auth::id()) {
            return back()->with('error', 'Anda tidak memiliki akses ke proposal ini.');
        }

        $proposal->update([
            'status' => 'waiting_signature',
            'data_confirmed_at' => now(),
        ]);

        return back()->with('success', 'Data berhasil dikonfirmasi. Menunggu tanda tangan ketua.');
    }
}
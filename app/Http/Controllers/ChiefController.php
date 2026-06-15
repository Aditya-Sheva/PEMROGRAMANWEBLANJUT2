<?php
namespace App\Http\Controllers;

use App\Models\Proposal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChiefController extends Controller
{
    public function index()
    {
        $proposals = Proposal::with(['user','decision'])
            ->where('status', 'waiting_signature')
            ->whereHas('decision', fn($q) => $q->where('chief_id', Auth::id()))
            ->latest()->paginate(10);

        $published = Proposal::with(['user','decision'])
            ->where('status', 'published')
            ->whereHas('decision', fn($q) => $q->where('chief_id', Auth::id()))
            ->latest()->paginate(10, ['*'], 'published');

        return view('chief.index', compact('proposals', 'published'));
    }

    public function uploadSignature(Request $request, Proposal $proposal)
    {
        $request->validate([
            'signature' => 'required|image|mimes:png,jpg,jpeg|max:5120',
        ]);

        if ($proposal->status !== 'waiting_signature') {
            return back()->with('error', 'Proposal belum menunggu tanda tangan.');
        }

        $decision = $proposal->decision;
        if (!$decision || $decision->chief_id !== Auth::id()) {
            return back()->with('error', 'Anda tidak ditugaskan sebagai ketua.');
        }

        $path = $request->file('signature')->store('signatures', 'public');
        $decision->update([
            'signature_path' => $path,
            'signed_at' => now(),
        ]);

        return back()->with('success', 'Tanda tangan berhasil diupload.');
    }
}
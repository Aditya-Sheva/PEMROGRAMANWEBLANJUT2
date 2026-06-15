<?php
namespace App\Http\Controllers;

use App\Models\Proposal;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class CertificateController extends Controller
{
    public function download(Proposal $proposal)
    {
        abort_unless($proposal->status === 'published', 403, 'Sertifikat belum tersedia.');
        $proposal->load('user','decision.secretary','decision.chief');

        $signatureDataUri = null;
        $signaturePath = $proposal->decision?->signature_path;
        if ($signaturePath && Storage::disk('public')->exists($signaturePath)) {
            $absolutePath = Storage::disk('public')->path($signaturePath);
            $mime = Storage::disk('public')->mimeType($signaturePath) ?: 'image/png';
            $data = @file_get_contents($absolutePath);
            if ($data !== false) {
                $signatureDataUri = 'data:'.$mime.';base64,'.base64_encode($data);
            }
        }

        $pdf = Pdf::loadView('certificates.ethical-clearance', compact('proposal', 'signatureDataUri'));
        $pdf->setPaper('A4','portrait');
        return $pdf->download("SKE-{$proposal->id}.pdf");
    }
}
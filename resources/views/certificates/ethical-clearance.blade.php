<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<style>
  @page{margin:2cm 2.5cm}
  body{font-family:'Times New Roman',Times,serif;font-size:12pt;color:#000;line-height:1.6}
  .header{text-align:center;border-bottom:3px double #1a3c5e;padding-bottom:16px;margin-bottom:24px}
  .logo-area{display:flex;align-items:center;justify-content:center;gap:16px;margin-bottom:10px}
  .logo-circle{width:60px;height:60px;border-radius:50%;background:#1a3c5e;display:flex;align-items:center;justify-content:center;color:#fff;font-size:24pt;font-weight:bold}
  .inst-name{font-size:15pt;font-weight:bold;color:#1a3c5e;margin:0}
  .inst-sub{font-size:10pt;color:#444;margin:2px 0}
  .cert-title{text-align:center;margin:20px 0 8px}
  .cert-title h2{font-size:14pt;font-weight:bold;text-transform:uppercase;letter-spacing:2px;margin:0}
  .cert-number{text-align:center;font-size:11pt;color:#555;margin-bottom:24px}
  .body-text{text-align:justify;margin-bottom:12px;font-size:12pt}
  .detail-table{width:100%;margin:20px 0;border-collapse:collapse}
  .detail-table td{padding:6px 10px;vertical-align:top;font-size:11.5pt}
  .detail-table td:first-child{width:38%;font-weight:normal;color:#333}
  .detail-table td:nth-child(2){width:4%;text-align:center}
  .detail-table tr:nth-child(odd){background:#f8f9fa}
  .status-badge{background:#1a3c5e;color:#fff;padding:4px 16px;border-radius:20px;font-size:11pt;font-weight:bold}
  /* Force signature section to a dedicated last page (option 2) */
  .signature-area{margin-top:48px;display:flex;justify-content:flex-end;page-break-before:always;break-before:page}
  .signature-box{text-align:center;width:220px}
  .stamp-placeholder{border:2px solid #1a3c5e;border-radius:8px;height:80px;margin:12px auto;width:180px;display:flex;align-items:center;justify-content:center;color:#aaa;font-size:9pt}
  .footer{margin-top:32px;border-top:1px solid #ccc;padding-top:10px;font-size:9pt;color:#777;text-align:center}
  .qr-area{float:right;text-align:center;margin-left:20px}
  .qr-box{width:70px;height:70px;border:1px solid #ccc;display:flex;align-items:center;justify-content:center;font-size:8pt;color:#aaa;border-radius:4px}
</style>
</head>
<body>

@php($signatureDataUri = $signatureDataUri ?? null)

<div class="header">
  <div class="logo-area">
    <div style="font-size:14pt;font-weight:bold;color:#1a3c5e">
      KOMITE ETIK PENELITIAN<br>
      <span style="font-size:12pt;font-weight:normal">Lembaga Penelitian dan Pengabdian Masyarakat</span>
    </div>
  </div>
  <div style="font-size:9.5pt;color:#555">
    Jl. Penelitian No. 1, Kota · Telp. (021) 1234-5678 · etik@institusi.ac.id
  </div>
</div>

<div class="cert-title">
  <h2>Surat Keterangan Kelaikan Etik</h2>
  <h2 style="font-size:12pt">(Ethical Clearance)</h2>
</div>
<div class="cert-number">
  Nomor: <strong>{{ $proposal->decision->certificate_number ?? 'SKE-'.date('Y').'-'.str_pad($proposal->id,4,'0',STR_PAD_LEFT) }}</strong>
</div>

<p class="body-text">
  Yang bertanda tangan di bawah ini, Ketua Komite Etik Penelitian, menerangkan bahwa
  proposal penelitian yang tercantum di bawah ini telah melalui proses penelaahan etik
  dan dinyatakan <strong>LAIK ETIK</strong> untuk dilaksanakan:
</p>

<table class="detail-table">
  <tr><td>Judul Penelitian</td><td>:</td><td><strong>{{ $proposal->title }}</strong></td></tr>
  <tr><td>Nama Peneliti Utama</td><td>:</td><td>{{ $proposal->researcher_name }}</td></tr>
  <tr><td>Institusi / Universitas</td><td>:</td><td>{{ $proposal->institution ?? 'Tidak dicantumkan' }}</td></tr>
  <tr><td>Jenis Review</td><td>:</td><td>{{ ucwords(str_replace('_',' ',$proposal->review_type ?? '-')) }}</td></tr>
  <tr><td>Tanggal Pengajuan</td><td>:</td><td>{{ \Carbon\Carbon::parse($proposal->submission_date)->locale('id')->isoFormat('D MMMM Y') }}</td></tr>
  <tr><td>Tanggal Keputusan</td><td>:</td>
    <td>{{ $proposal->decision ? \Carbon\Carbon::parse($proposal->decision->decided_at)->locale('id')->isoFormat('D MMMM Y') : \Carbon\Carbon::now()->locale('id')->isoFormat('D MMMM Y') }}</td>
  </tr>
  <tr><td>Status</td><td>:</td><td><span class="status-badge">DISETUJUI / APPROVED</span></td></tr>
</table>

<p class="body-text">
  Surat Keterangan Kelaikan Etik ini diterbitkan berdasarkan hasil penelaahan Komite Etik
  Penelitian dan menyatakan bahwa penelitian ini telah memenuhi prinsip-prinsip etik penelitian
  yang meliputi: menghormati harkat dan martabat manusia, berbuat baik dan tidak merugikan,
  keadilan, serta memperhatikan kerahasiaan subjek penelitian.
</p>

@if($proposal->decision && $proposal->decision->notes)
<p class="body-text">
  <strong>Catatan Khusus:</strong> {{ $proposal->decision->notes }}
</p>
@endif

<p class="body-text">
  Surat keterangan ini berlaku selama <strong>1 (satu) tahun</strong> sejak tanggal ditetapkan
  dan wajib diperpanjang apabila penelitian belum selesai dilaksanakan.
</p>

<div class="signature-area">
  <div class="signature-box">
    <div>{{ \Carbon\Carbon::now()->locale('id')->isoFormat('D MMMM Y') }}</div>
    <div style="margin-top:4px">Ketua Komite Etik Penelitian,</div>
    @if(!empty($signatureDataUri))
      <div style="margin:12px auto;width:180px;height:80px;display:flex;align-items:center;justify-content:center">
        <img src="{{ $signatureDataUri }}" style="max-width:180px;max-height:80px" alt="TTD Ketua">
      </div>
    @else
      <div class="stamp-placeholder">[ Stempel & TTD ]</div>
    @endif
    <div><strong>{{ $proposal->decision->chief->name ?? 'Ketua Komite' }}</strong></div>
    <div style="font-size:9.5pt;color:#555">NIP/NIK. _______________</div>
  </div>
</div>

<div class="footer">
  Dokumen ini digenerate secara otomatis oleh Sistem Informasi Etik Penelitian pada
  {{ \Carbon\Carbon::now()->locale('id')->isoFormat('D MMMM Y, HH:mm') }} WIB.
  Sah tanpa tanda tangan basah apabila memiliki nomor sertifikat yang valid.
</div>

</body>
</html>
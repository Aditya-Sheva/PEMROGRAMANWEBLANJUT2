<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<style>
  @page {
    margin: 2cm 2.5cm 2cm 2.5cm;
  }
  * {
    box-sizing: border-box;
  }
  body {
    font-family: 'Times New Roman', Times, serif;
    font-size: 11pt;
    color: #000;
    line-height: 1.4;
    margin: 0;
    padding: 0;
  }

  /* ===== KOP SURAT ===== */
  .kop {
    width: 100%;
    border-bottom: 4px double #000;
    padding-bottom: 10px;
    margin-bottom: 14px;
  }
  .kop-table {
    width: 100%;
    border-collapse: collapse;
  }
  .kop-logo {
    width: 70px;
    text-align: center;
    vertical-align: middle;
  }
  .kop-logo-circle {
    width: 60px;
    height: 60px;
    border: 3px solid #000;
    border-radius: 50%;
    display: inline-block;
    line-height: 54px;
    text-align: center;
    font-size: 9pt;
    font-weight: bold;
  }
  .kop-text {
    vertical-align: middle;
    padding-left: 10px;
  }
  .kop-text .inst-main {
    font-size: 14pt;
    font-weight: bold;
    text-transform: uppercase;
    letter-spacing: 1px;
  }
  .kop-text .inst-sub {
    font-size: 11pt;
    font-weight: bold;
  }
  .kop-text .inst-addr {
    font-size: 9pt;
    margin-top: 2px;
  }
  .kop-nomor {
    width: 110px;
    text-align: right;
    vertical-align: top;
    font-size: 9pt;
    color: #333;
  }

  /* ===== JUDUL FORM ===== */
  .form-title {
    text-align: center;
    margin: 10px 0 4px 0;
  }
  .form-title h2 {
    font-size: 13pt;
    font-weight: bold;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin: 0 0 2px 0;
  }
  .form-title .form-sub {
    font-size: 10pt;
    margin: 0;
  }
  .form-title .form-code {
    font-size: 10pt;
    font-weight: bold;
    border: 1px solid #000;
    display: inline-block;
    padding: 2px 14px;
    margin-top: 4px;
    letter-spacing: 1px;
  }
  .divider {
    border: none;
    border-top: 1.5px solid #000;
    margin: 8px 0;
  }

  /* ===== SECTION ===== */
  .section {
    margin-bottom: 12px;
  }
  .section-title {
    font-size: 11pt;
    font-weight: bold;
    text-transform: uppercase;
    background: #e8e8e8;
    padding: 3px 8px;
    margin-bottom: 6px;
    border-left: 4px solid #000;
  }

  /* ===== FIELD ROWS ===== */
  .field-table {
    width: 100%;
    border-collapse: collapse;
  }
  .field-table tr {
    vertical-align: top;
  }
  .field-table td {
    padding: 3px 4px;
    font-size: 11pt;
  }
  .field-num {
    width: 22px;
    text-align: right;
    padding-right: 4px;
    white-space: nowrap;
  }
  .field-label {
    width: 155px;
    white-space: nowrap;
  }
  .field-colon {
    width: 12px;
    text-align: center;
  }
  .field-value {
    /* takes remaining width */
  }
  .field-line {
    display: block;
    border-bottom: 1px solid #000;
    min-height: 16px;
    width: 100%;
    margin-bottom: 4px;
  }
  .field-line-short {
    display: inline-block;
    border-bottom: 1px solid #000;
    min-height: 16px;
    width: 140px;
  }
  .field-line-long {
    display: block;
    border-bottom: 1px solid #000;
    min-height: 16px;
    width: 100%;
    margin-bottom: 4px;
  }
  .field-multiline .field-line {
    margin-bottom: 3px;
  }

  /* ===== CHECKBOX ROWS ===== */
  .check-row {
    display: inline-block;
    margin-right: 18px;
    font-size: 11pt;
  }
  .check-box {
    display: inline-block;
    width: 12px;
    height: 12px;
    border: 1px solid #000;
    vertical-align: middle;
    margin-right: 4px;
  }

  /* ===== TANDA TANGAN ===== */
  .ttd-section {
    margin-top: 18px;
  }
  .ttd-table {
    width: 100%;
    border-collapse: collapse;
  }
  .ttd-table td {
    vertical-align: top;
    padding: 0 8px;
    font-size: 11pt;
  }
  .ttd-box {
    text-align: center;
  }
  .ttd-space {
    height: 60px;
    border-bottom: 1px solid #000;
    margin: 6px 0;
  }
  .ttd-name-line {
    border-bottom: 1px solid #000;
    min-height: 16px;
    margin-top: 4px;
  }

  /* ===== FOOTER ===== */
  .doc-footer {
    margin-top: 16px;
    border-top: 1px solid #999;
    padding-top: 6px;
    font-size: 8pt;
    color: #555;
    text-align: center;
  }

  /* ===== PETUNJUK ===== */
  .petunjuk {
    font-size: 9pt;
    color: #444;
    margin-bottom: 10px;
    padding: 6px 10px;
    border: 1px dashed #999;
    background: #fafafa;
  }
  .petunjuk ul {
    margin: 4px 0 0 0;
    padding-left: 18px;
  }
  .petunjuk ul li {
    margin-bottom: 2px;
  }
</style>
</head>
<body>

{{-- ===== KOP SURAT ===== --}}
<div class="kop">
  <table class="kop-table">
    <tr>
      <td class="kop-logo">
        <div class="kop-logo-circle">KETK</div>
      </td>
      <td class="kop-text">
        <div class="inst-main">Komite Etik Penelitian Kesehatan</div>
        <div class="inst-sub">Lembaga Penelitian dan Pengabdian Masyarakat</div>
        <div class="inst-addr">
          Jl. Penelitian No. 1, Kota &nbsp;|&nbsp; Telp: (021) 1234-5678 &nbsp;|&nbsp; Email: etik@institusi.ac.id
        </div>
      </td>
      <td class="kop-nomor">
        Kode Dok: SKE-1<br>
        Revisi: 00<br>
        Tgl: {{ date('d/m/Y') }}
      </td>
    </tr>
  </table>
</div>

{{-- ===== JUDUL ===== --}}
<div class="form-title">
  <h2>Formulir Pengajuan Ethical Clearance</h2>
  <p class="form-sub">Komite Etik Penelitian Kesehatan (KETK)</p>
  <span class="form-code">SKE-1 / KETK / {{ date('Y') }}</span>
</div>
<hr class="divider">

{{-- ===== PETUNJUK PENGISIAN ===== --}}
<div class="petunjuk">
  <strong>Petunjuk Pengisian:</strong>
  <ul>
    <li>Isi formulir ini dengan lengkap dan jelas menggunakan huruf cetak atau diketik.</li>
    <li>Lampirkan dokumen pendukung sesuai daftar persyaratan yang berlaku.</li>
    <li>Formulir yang tidak lengkap tidak akan diproses.</li>
    <li>Kirimkan formulir beserta lampiran ke Sekretariat KETK.</li>
  </ul>
</div>

{{-- ===== A. INFORMASI UMUM ===== --}}
<div class="section">
  <div class="section-title">A. Informasi Umum</div>
  <table class="field-table">
    <tr>
      <td class="field-num">1.</td>
      <td class="field-label">Judul Penelitian</td>
      <td class="field-colon">:</td>
      <td class="field-value">
        <span class="field-line"></span>
        <span class="field-line"></span>
      </td>
    </tr>
    <tr>
      <td class="field-num">2.</td>
      <td class="field-label">Nama Peneliti Utama</td>
      <td class="field-colon">:</td>
      <td class="field-value"><span class="field-line"></span></td>
    </tr>
    <tr>
      <td class="field-num">3.</td>
      <td class="field-label">NIM / NIP / NIK</td>
      <td class="field-colon">:</td>
      <td class="field-value"><span class="field-line"></span></td>
    </tr>
    <tr>
      <td class="field-num">4.</td>
      <td class="field-label">Institusi / Universitas</td>
      <td class="field-colon">:</td>
      <td class="field-value"><span class="field-line"></span></td>
    </tr>
    <tr>
      <td class="field-num">5.</td>
      <td class="field-label">Fakultas / Departemen</td>
      <td class="field-colon">:</td>
      <td class="field-value"><span class="field-line"></span></td>
    </tr>
    <tr>
      <td class="field-num">6.</td>
      <td class="field-label">Email</td>
      <td class="field-colon">:</td>
      <td class="field-value"><span class="field-line"></span></td>
    </tr>
    <tr>
      <td class="field-num">7.</td>
      <td class="field-label">No. Telepon / HP</td>
      <td class="field-colon">:</td>
      <td class="field-value"><span class="field-line"></span></td>
    </tr>
    <tr>
      <td class="field-num">8.</td>
      <td class="field-label">Anggota Tim Peneliti</td>
      <td class="field-colon">:</td>
      <td class="field-value">
        <span class="field-line"></span>
        <span class="field-line"></span>
      </td>
    </tr>
    <tr>
      <td class="field-num">9.</td>
      <td class="field-label">Pembimbing / Supervisor</td>
      <td class="field-colon">:</td>
      <td class="field-value"><span class="field-line"></span></td>
    </tr>
    <tr>
      <td class="field-num">10.</td>
      <td class="field-label">Tanggal Pengajuan</td>
      <td class="field-colon">:</td>
      <td class="field-value"><span class="field-line"></span></td>
    </tr>
  </table>
</div>

{{-- ===== B. JENIS PENELITIAN ===== --}}
<div class="section">
  <div class="section-title">B. Jenis Penelitian</div>
  <table class="field-table">
    <tr>
      <td class="field-num">1.</td>
      <td class="field-label">Jenis Review</td>
      <td class="field-colon">:</td>
      <td class="field-value">
        <span class="check-row"><span class="check-box"></span> Exempted Review</span>
        <span class="check-row"><span class="check-box"></span> Expedited Review</span>
        <span class="check-row"><span class="check-box"></span> Full Board Review</span>
      </td>
    </tr>
    <tr>
      <td class="field-num">2.</td>
      <td class="field-label">Desain Penelitian</td>
      <td class="field-colon">:</td>
      <td class="field-value">
        <span class="check-row"><span class="check-box"></span> Observasional</span>
        <span class="check-row"><span class="check-box"></span> Eksperimental</span>
        <span class="check-row"><span class="check-box"></span> Kualitatif</span>
        <span class="check-row"><span class="check-box"></span> Lainnya: <span class="field-line-short"></span></span>
      </td>
    </tr>
    <tr>
      <td class="field-num">3.</td>
      <td class="field-label">Lokasi Penelitian</td>
      <td class="field-colon">:</td>
      <td class="field-value"><span class="field-line"></span></td>
    </tr>
    <tr>
      <td class="field-num">4.</td>
      <td class="field-label">Periode Penelitian</td>
      <td class="field-colon">:</td>
      <td class="field-value">
        Mulai: <span class="field-line-short"></span>&nbsp;&nbsp;
        s.d.: <span class="field-line-short"></span>
      </td>
    </tr>
  </table>
</div>

{{-- ===== C. RINGKASAN PENELITIAN ===== --}}
<div class="section">
  <div class="section-title">C. Ringkasan Penelitian</div>
  <table class="field-table">
    <tr>
      <td class="field-num">1.</td>
      <td class="field-label">Latar Belakang</td>
      <td class="field-colon">:</td>
      <td class="field-value">
        <span class="field-line"></span>
        <span class="field-line"></span>
        <span class="field-line"></span>
      </td>
    </tr>
    <tr>
      <td class="field-num">2.</td>
      <td class="field-label">Tujuan Penelitian</td>
      <td class="field-colon">:</td>
      <td class="field-value">
        <span class="field-line"></span>
        <span class="field-line"></span>
      </td>
    </tr>
    <tr>
      <td class="field-num">3.</td>
      <td class="field-label">Metode Penelitian</td>
      <td class="field-colon">:</td>
      <td class="field-value">
        <span class="field-line"></span>
        <span class="field-line"></span>
      </td>
    </tr>
  </table>
</div>

{{-- ===== D. SUBJEK PENELITIAN ===== --}}
<div class="section">
  <div class="section-title">D. Subjek Penelitian</div>
  <table class="field-table">
    <tr>
      <td class="field-num">1.</td>
      <td class="field-label">Melibatkan Manusia</td>
      <td class="field-colon">:</td>
      <td class="field-value">
        <span class="check-row"><span class="check-box"></span> Ya</span>
        <span class="check-row"><span class="check-box"></span> Tidak</span>
      </td>
    </tr>
    <tr>
      <td class="field-num">2.</td>
      <td class="field-label">Jumlah Subjek</td>
      <td class="field-colon">:</td>
      <td class="field-value">
        <span class="field-line-short"></span> orang
      </td>
    </tr>
    <tr>
      <td class="field-num">3.</td>
      <td class="field-label">Kriteria Inklusi</td>
      <td class="field-colon">:</td>
      <td class="field-value">
        <span class="field-line"></span>
        <span class="field-line"></span>
      </td>
    </tr>
    <tr>
      <td class="field-num">4.</td>
      <td class="field-label">Kriteria Eksklusi</td>
      <td class="field-colon">:</td>
      <td class="field-value">
        <span class="field-line"></span>
        <span class="field-line"></span>
      </td>
    </tr>
    <tr>
      <td class="field-num">5.</td>
      <td class="field-label">Informed Consent</td>
      <td class="field-colon">:</td>
      <td class="field-value">
        <span class="check-row"><span class="check-box"></span> Ada (terlampir)</span>
        <span class="check-row"><span class="check-box"></span> Tidak diperlukan</span>
      </td>
    </tr>
  </table>
</div>

{{-- ===== E. RISIKO & MANFAAT ===== --}}
<div class="section">
  <div class="section-title">E. Risiko &amp; Manfaat</div>
  <table class="field-table">
    <tr>
      <td class="field-num">1.</td>
      <td class="field-label">Risiko Potensial</td>
      <td class="field-colon">:</td>
      <td class="field-value">
        <span class="check-row"><span class="check-box"></span> Minimal</span>
        <span class="check-row"><span class="check-box"></span> Sedang</span>
        <span class="check-row"><span class="check-box"></span> Tinggi</span>
      </td>
    </tr>
    <tr>
      <td class="field-num">2.</td>
      <td class="field-label">Uraian Risiko</td>
      <td class="field-colon">:</td>
      <td class="field-value">
        <span class="field-line"></span>
        <span class="field-line"></span>
      </td>
    </tr>
    <tr>
      <td class="field-num">3.</td>
      <td class="field-label">Manfaat Penelitian</td>
      <td class="field-colon">:</td>
      <td class="field-value">
        <span class="field-line"></span>
        <span class="field-line"></span>
      </td>
    </tr>
    <tr>
      <td class="field-num">4.</td>
      <td class="field-label">Kerahasiaan Data</td>
      <td class="field-colon">:</td>
      <td class="field-value">
        <span class="check-row"><span class="check-box"></span> Dijamin kerahasiaannya</span>
        <span class="check-row"><span class="check-box"></span> Data dipublikasikan</span>
      </td>
    </tr>
  </table>
</div>

{{-- ===== F. DOKUMEN YANG DILAMPIRKAN ===== --}}
<div class="section">
  <div class="section-title">F. Dokumen yang Dilampirkan</div>
  <table class="field-table">
    <tr>
      <td style="width:22px; padding:3px 4px; font-size:11pt;"></td>
      <td style="font-size:11pt; padding:3px 4px;">
        <span class="check-row"><span class="check-box"></span> Proposal Penelitian</span>
        <span class="check-row"><span class="check-box"></span> CV Peneliti Utama</span>
        <span class="check-row"><span class="check-box"></span> Informed Consent</span><br><br>
        <span class="check-row"><span class="check-box"></span> Kuesioner / Instrumen</span>
        <span class="check-row"><span class="check-box"></span> Surat Izin Institusi</span>
        <span class="check-row"><span class="check-box"></span> Lainnya: <span class="field-line-short"></span></span>
      </td>
    </tr>
  </table>
</div>

{{-- ===== G. PERNYATAAN PENELITI ===== --}}
<div class="section">
  <div class="section-title">G. Pernyataan Peneliti</div>
  <p style="font-size:11pt; margin: 6px 0 10px 0; text-align:justify;">
    Saya yang bertanda tangan di bawah ini menyatakan bahwa semua informasi yang tercantum dalam
    formulir ini adalah benar dan lengkap. Saya bersedia mematuhi semua ketentuan etik penelitian
    yang ditetapkan oleh Komite Etik Penelitian Kesehatan (KETK) dan akan melaporkan setiap
    perubahan protokol penelitian kepada KETK.
  </p>

  <table class="ttd-table">
    <tr>
      <td style="width:50%; padding: 0 20px 0 0;">
        <div>Tempat, Tanggal:</div>
        <div class="ttd-space"></div>
        <div style="font-size:9pt; color:#555; margin-top:2px;">Kota, DD/MM/YYYY</div>
      </td>
      <td style="width:50%; padding: 0 0 0 20px;">
        <div>Tanda Tangan Peneliti Utama,</div>
        <div class="ttd-space"></div>
        <div>Nama Lengkap:</div>
        <div class="ttd-name-line"></div>
        <div style="font-size:9pt; color:#555; margin-top:2px;">NIM/NIP/NIK: ___________________</div>
      </td>
    </tr>
  </table>
</div>

{{-- ===== KOLOM UNTUK SEKRETARIAT ===== --}}
<div class="section" style="margin-top:14px;">
  <div class="section-title" style="background:#d0d0d0;">H. Diisi oleh Sekretariat KETK</div>
  <table class="field-table">
    <tr>
      <td class="field-num">1.</td>
      <td class="field-label">No. Registrasi</td>
      <td class="field-colon">:</td>
      <td class="field-value"><span class="field-line"></span></td>
    </tr>
    <tr>
      <td class="field-num">2.</td>
      <td class="field-label">Tanggal Diterima</td>
      <td class="field-colon">:</td>
      <td class="field-value"><span class="field-line"></span></td>
    </tr>
    <tr>
      <td class="field-num">3.</td>
      <td class="field-label">Jenis Review</td>
      <td class="field-colon">:</td>
      <td class="field-value"><span class="field-line"></span></td>
    </tr>
    <tr>
      <td class="field-num">4.</td>
      <td class="field-label">Catatan</td>
      <td class="field-colon">:</td>
      <td class="field-value">
        <span class="field-line"></span>
        <span class="field-line"></span>
      </td>
    </tr>
  </table>
  <table class="ttd-table" style="margin-top:10px;">
    <tr>
      <td style="width:50%; padding: 0 20px 0 0;">
        <div>Diterima oleh,</div>
        <div class="ttd-space"></div>
        <div>Nama &amp; Tanda Tangan:</div>
        <div class="ttd-name-line"></div>
      </td>
      <td style="width:50%; padding: 0 0 0 20px;">
        <div>Stempel KETK:</div>
        <div style="border: 1.5px solid #000; height: 70px; margin-top:4px; border-radius:4px;"></div>
      </td>
    </tr>
  </table>
</div>

{{-- ===== FOOTER ===== --}}
<div class="doc-footer">
  Formulir SKE-1 &mdash; Komite Etik Penelitian Kesehatan (KETK) &mdash; Dicetak: {{ date('d/m/Y H:i') }} WIB
  &nbsp;|&nbsp; Dokumen ini sah sebagai formulir resmi pengajuan ethical clearance.
</div>

</body>
</html>

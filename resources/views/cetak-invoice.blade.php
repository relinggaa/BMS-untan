<!-- resources/views/cetak-invoice.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cetak Invoice</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      padding: 20px;
      margin: 0;
      background-color: #f9f9f9;
    }
    .header {
      display: flex;
      justify-content: center;
      align-items: center;
      margin-bottom: 20px;
      border-bottom: 2px solid #000;
      padding-bottom: 10px;
      gap: 20px;
    }
    .logo {
      width: 120px;
      height: auto;
    }
    .header-text {
      text-align: left;
      font-size: 14px;
    }
    .header-text h1 {
      font-size: 24px;
      margin: 0;
    }
    .header-text h3 {
      margin: 5px 0;
    }
    .header-text p {
      margin: 5px 0;
    }
    .header-text a {
      color: #007bff;
    }
    h1, h2 {
      text-align: center;
      margin-bottom: 20px;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 20px;
    }
    th, td {
      border: 1px solid #ddd;
      padding: 8px 12px;
      text-align: left;
      font-size: 14px;
    }
    th {
      background-color: #f2f2f2;
    }
    td {
      background-color: #ffffff;
    }
    button {
      display: block;
      margin: 0 auto;
      padding: 10px 20px;
      background-color: #007bff;
      color: white;
      font-size: 16px;
      border: none;
      cursor: pointer;
      border-radius: 5px;
    }
    button:hover {
      background-color: #0056b3;
    }
    @media print {
      button {
        display: none;
      }
      body {
        background-color: white;
      }
    }
  </style>
</head>
<body>

  <div class="header">
    <img src="{{ asset('img/logo.png') }}" alt="Logo" class="logo">
    <div class="header-text">
      <h1>KEMENTRIAN PENDIDIKAN, KEBUDAYAAN,</h1>
      <h3>UNIVERSITAS TANJUNGPURA</h3>
      <p>FAKULTAS TEKNIK LABORATORIUM BAHAN DAN KONSTRUKSI</p>
      <p>Email: <a href="mailto:lab.bahan@untan.ac.id">lab.bahan@untan.ac.id</a> | Website: <a href="http://labtk.untan.ac.id">labtk.untan.ac.id</a></p>
    </div>
  </div>

  <h1>Invoice - {{ $invoice->no_invoice }}</h1>

  <h2>Detail Invoice</h2>
  <table>
    <tr>
      <th>No. Invoice</th>
      <td>{{ $invoice->no_invoice }}</td>
    </tr>
    <tr>
      <th>Nama Perusahaan</th>
      <td>{{ $invoice->nama_perusahaan }}</td>
    </tr>
    <tr>
      <th>Nama Proyek</th>
      <td>{{ $invoice->nama_proyek }}</td>
    </tr>
    <tr>
      <th>Permohonan</th>
      <td>{{ $invoice->permohonan }}</td>
    </tr>
    <tr>
      <th>Tanggal Datang</th>
      <td>{{ $invoice->tanggal_datang }}</td>
    </tr>
    <tr>
      <th>Jenis Material</th>
      <td>{{ $invoice->jenis_material }}</td>
    </tr>
    <tr>
      <th>Jenis Pengujian</th>
      <td>{{ $invoice->jenis_pengujian }}</td>
    </tr>
    <tr>
      <th>Jumlah</th>
      <td>{{ $invoice->jumlah }}</td>
    </tr>
    <tr>
      <th>Total Biaya</th>
      <td>Rp. {{ number_format($invoice->total_biaya, 2) }}</td>
    </tr>
    <tr>
      <th>Teknisi</th>
      <td>{{ $invoice->teknisi }}</td>
    </tr>
  </table>

  <button onclick="window.print()">Print Invoice</button>

</body>
</html>

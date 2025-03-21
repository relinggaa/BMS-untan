<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kwitansi Detail</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 50%;
            margin: 0 auto;
        }
        .header {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 30px;
            padding-left: 10%;
        }
        .logo {
            width: 100px; 
            margin-right: 20px; 
        }
        .header-text {
            text-align: left; 
            line-height: 1.2;
            flex-grow: 1; 
        }
        .header-text h3, .header-text h4, .header-text p {
            margin: 0;
            padding: 0;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .table td {
            padding: 8px;
            border: 1px solid #000;
            vertical-align: top;
        }
        .table th {
            padding: 8px;
            text-align: left;
            border: 1px solid #000;
            background-color: #f0f0f0;
        }
        .text-right {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .footer {
            text-align: center;
            margin-top: 50px;
        }

        /* Media Query for Print */
        @media print {
            .no-print {
                display: none;
            }
            .container {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <!-- Logo di kiri -->
            <img src="{{ asset('img/logo.png') }}" alt="Logo" class="logo">
            
            <!-- Teks header di kanan -->
            <div class="header-text">
                <h3>KEMENTRIAN PENDIDIKAN, KEBUDAYAAN,</h3>
                <h3>UNIVERSITAS TANUNGPURA</h3>
                <h4>FAKULTAS TEKNIK</h4>
                <p>LABORATORIUM BAHAN DAN KONSTRUKSI</p>
                <p>Jalan Prof. Dr. H. Hadari Nawawi Pontianak 7824 Telepon (0561) 740186</p>
                <p>Email: <a href="mailto:lab.bahan@untan.ac.id">lab.bahan@untan.ac.id</a> | Website: <a href="http://labtk.untan.ac.id">labtk.untan.ac.id</a></p>
            </div>
        </div>

        <h4 class="text-center">KWITANSI</h4>

        <!-- Tabel Data Kwitansi -->
        <table class="table">
            <tr>
                <th>Nomor Invoice</th>
                <td>{{ $kwitansi->nomor_invoice }}</td>
            </tr>
            <tr>
                <th>Supplier</th>
                <td>{{ $kwitansi->supplier }}</td>
            </tr>
            <tr>
                <th>Proyek</th>
                <td>{{ $kwitansi->proyek }}</td>
            </tr>
            <tr>
                <th>Total Tagihan</th>
                <td>Rp. {{ number_format($kwitansi->total_tagihan, 2) }}</td>
            </tr>
            <tr>
                <th>Jenis Pembayaran</th>
                <td>{{ $kwitansi->jenis_pembayaran }}</td>
            </tr>
            <tr>
                <th>Untuk Pembayaran</th>
                <td>{{ $kwitansi->untuk_pembayaran }}</td>
            </tr>
            <tr>
                <th>Untuk Pembayaran</th>
                <td>{{ $kwitansi->telah_diterima }}</td>
            </tr>
            <tr>
                <th>Tanggal</th>
                <td>{{ \Carbon\Carbon::parse($kwitansi->created_at)->format('d-m-Y') }}</td>
            </tr>
        </table>

        <div class="footer">
            <div class="text-center">
                <img src="{{ asset('img/ttd.png') }}" alt="Barcode" style="width: 150px; height: auto;">
            </div>
            <p>Erwin Sutandar</p>
          
     <p class="mt-5">Pontianak, <span id="tanggal-formatted"> {{ \Carbon\Carbon::parse($kwitansi->tanggal)->locale('id')->format('d F Y') }}</span></p>
     <p class="mt-5"><i> Di Tandatangani secara elektronik</i></p>
    </div>

        </div>

        <div class="text-center mt-4 no-print">
            <a href="{{ url()->previous() }}" class="btn btn-secondary">Kembali</a>
            <button onclick="window.print();" class="btn btn-primary">Print</button>
        </div>
    </div>
    <script>
                // Ambil elemen tanggal dari HTML
                var tanggalStr = "{{ \Carbon\Carbon::parse($kwitansi->created_at)->format('Y-m-d') }}"; // Menggunakan PHP untuk memformat tanggal

                    // Parsing tanggal dengan JavaScript
                    var tanggal = new Date(tanggalStr);

                    // Format tanggal menggunakan 'id-ID'
                    var options = { year: 'numeric', month: 'long', day: 'numeric' };
                    var tanggalFormatted = new Intl.DateTimeFormat('id-ID', options).format(tanggal);

                    // Masukkan tanggal yang sudah diformat ke dalam elemen dengan id 'tanggal-formatted'
                    document.getElementById('tanggal-formatted').textContent = tanggalFormatted;
                    </script>
    </script>
</body>
</html>

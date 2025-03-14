<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
  <title>Dashboard - Bookkeeping Management System</title>
  <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" />
  <link rel="stylesheet" href="/dashboard/assets/vendor/fonts/boxicons.css" />
  <link rel="stylesheet" href="/dashboard/assets/vendor/css/core.css" class="template-customizer-core-css" />
  <link rel="stylesheet" href="/dashboard/assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
  <link rel="stylesheet" href="/dashboard/assets/css/demo.css" />
  <link rel="stylesheet" href="/dashboard/assets/vendor/css/pages/page-auth.css" />

  <script src="/dashboard/assets/vendor/js/helpers.js"></script>
  <script src="/dashboard/assets/js/config.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>
<style>
      #layout-menu ul li a {
      display: flex;
      align-items: center;
      font-size: 1rem;
      color: #6c757d;
      padding: 0.75rem 1rem;
      text-decoration: none;
      border-radius: 0.375rem;
      transition: background-color 0.2s ease;
    }
    #layout-menu ul li a:hover {
      background-color: #ced4da;
    }
</style>
<body>
  <!-- Verifikasi Session -->
  @if (!session('login_pelaporan'))
  <script>
    alert("Anda harus login terlebih dahulu.");
    window.location.href = "{{ route('login.pelaporan') }}";
  </script>
  @endif

  <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
      <!-- Menu -->
      <aside id="layout-menu" class="d-none d-lg-block p-3 bg-menu-theme" style="width: 250px; min-height: 100vh;">
        <h4 class="text-center">Pelaporan</h4>
        <ul class="list-unstyled">
          <li><a href="#" class="d-block p-2" onclick="showContent('dataPelanggan')"><i class="menu-icon bx bx-user"></i>Data Pelanggan</a></li>
          <li><a href="#" class="d-block p-2" onclick="showContent('lembarPengujian')"><i class="menu-icon bx bx-calendar"></i>Lembar Pengujian</a></li>
          <li><a href="#" class="d-block p-2" onclick="showContent('invoiceLab')"><i class="menu-icon bx bx-file"></i>Invoice Lab</a></li>
          <li><a href="#" class="d-block p-2" onclick="showContent('invoiceLapangan')"><i class="menu-icon bx bx-download"></i>Invoice Lapangan</a></li>
          <li><a href="#" class="d-block p-2" onclick="showContent('laporan')"><i class="menu-icon bx bx-file"></i>Laporan</a></li>
          <li class="menu-item">
            <form action="{{ route('logout') }}" method="POST">
              @csrf
              <button type="submit" class="menu-link w-100 text-start bg-transparent" style="border:none;">
                <i class="menu-icon tf-icons bx bx-log-out"></i>
                <div>Logout</div>
              </button>
            </form>
          </li>
        </ul>
      </aside>
      
      <!-- Main Content -->
      <div class="flex-grow-1">
        <!-- Navbar (Tampil di Mobile) -->
        <nav class="navbar navbar-expand-lg navbar-light d-lg-none bg-menu-theme">
          <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
              <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="#" onclick="showContent('dataPelanggan')"><i class="menu-icon bx bx-pencil"></i>Tampilkan Data</a></li>
                <li class="menu-item">
                  <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="menu-link w-100 text-start bg-transparent" style="border:none;">
                      <i class="menu-icon tf-icons bx bx-log-out"></i>
                      <div>Logout</div>
                    </button>
                  </form>
                </li>
              </ul>
            </div>
          </div>
        </nav>
      <!-- / Menu -->
      <div id="mainContent">
        <h2>Select a section from the menu</h2>
      </div>

         

          <!-- / Content -->
        </div>
      </div>
    </div>
  </div>

  <script src="/dashboard/assets/vendor/libs/jquery/jquery.js"></script>
  <script src="/dashboard/assets/vendor/libs/popper/popper.js"></script>
  <script src="/dashboard/assets/vendor/js/bootstrap.js"></script>
  <script src="/dashboard/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
  <script src="/dashboard/assets/vendor/js/menu.js"></script>
  <script src="/dashboard/assets/js/main.js"></script>

  <script>
      const lembarPengujianPelaporan = @json($lembarPengujianPelaporan);

    function showContent(page) {
      const content = {
        dataPelanggan: `
           <h2>Data Pelanggan</h2>
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>No Invoice</th>
            <th>Nama Perusahaan</th>
            <th>Nama Proyek</th>
            <th>Permohonan</th>
            <th>Tanggal Datang</th>
            <th>Kegiatan</th>
            <th>Keterangan</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($dataPelanggan as $pelanggan)
            <tr>
              <td>{{ $pelanggan->no_invoice }}</td>
              <td>{{ $pelanggan->nama_perusahaan }}</td>
              <td>{{ $pelanggan->nama_proyek }}</td>
              <td>{{ $pelanggan->permohonan }}</td>
              <td>{{ $pelanggan->tanggal_datang }}</td>
              <td>{{ $pelanggan->kegiatan }}</td>
              <td>{{ $pelanggan->keterangan }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>`,
        
      lembarPengujian: `
      
            <h2>Lembar Pengujian</h2>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>File Name</th>
               
                    </tr>
                </thead>
                <tbody>
                    ${lembarPengujianPelaporan.map(lembar => {
                        return `
                            <tr>
                                <td>
                                    <a href="${'{{ asset("storage/") }}' + '/' + lembar.file_path}" target="_blank">
                                        ${lembar.file_path.split('/').pop()}
                                    </a>
                                </td>
                                
                              
                            </tr>
                        `;
                    }).join('')}
                </tbody>
            </table>`,

        invoiceLab: `<h2>Invoice Lab</h2>
   
    
    <table class="table table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Excel</th>
                <th>Excel Lab Dengan Harga</th>
                <th>Teknisi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($invoices as $index => $invoice)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>
                        <a href="{{ asset('storage/' . $invoice->excel_lab) }}" target="_blank">
                            {{ basename($invoice->excel_lab) }}
                        </a>
                    </td>
                    <td>
                        <a href="{{ asset('storage/' . $invoice->excel_lab_dengan_harga) }}" target="_blank">
                            {{ basename($invoice->excel_lab_dengan_harga) }}
                        </a>
                    </td>
                    <td>{{ $invoice->teknisi }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>`,

        invoiceLapangan: `<h2>Invoice Lapangan</h2>
<table class="table table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>Excel Lab</th>
            <th>Excel Lab Dengan Harga</th>
            <th>Teknisi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($invoiceLapangan as $index => $invoice)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>
                    <a href="{{ asset('storage/' . $invoice->excel_lab) }}" target="_blank">
                        {{ basename($invoice->excel_lab) }}
                    </a>
                </td>
                <td>
                    <a href="{{ asset('storage/' . $invoice->excel_lab_dengan_harga) }}" target="_blank">
                        {{ basename($invoice->excel_lab_dengan_harga) }}
                    </a>
                </td>
                <td>{{ $invoice->teknisi }}</td>
            </tr>
        @endforeach
    </tbody>
</table>`,



laporan: `
  <h2>Laporan</h2>
  <form action="{{ route('laporan.upload') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
      <label for="file_pdf" class="form-label">Upload PDF</label>
      <input type="file" class="form-control" id="file_pdf" name="file_pdf" accept="application/pdf" required>
    </div>
    <button type="submit" class="btn btn-primary">Upload PDF</button>
  </form>

<h3>Uploaded Laporan</h3>
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>File Name</th>
            <th>Action</th>
            <th>Send to Penyelia</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($laporanFiles as $file)
          <tr>
            <td><a href="{{ asset('storage/' . $file->file_path) }}" target="_blank">{{ basename($file->file_path) }}</a></td>
            <td>
                <form action="{{ route('laporan.delete', $file->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus file?')" 
                    {{ $file->sent_to_penyelia ? 'disabled' : '' }}>
                        Delete
                    </button>
                </form>
            </td>
            <td>
                <!-- Disable button if sent_to_penyelia is 1 -->
                <form action="{{ route('laporan.sendToPenyelia', $file->id) }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Apakah Anda yakin ingin mengirim ke Penyelia?')" 
                    {{ $file->sent_to_penyelia ? 'disabled' : '' }}>
                        Kirim Ke Penyelia
                    </button>
                </form>
            </td>
          </tr>
        @endforeach
    </tbody>
</table>



`
      };

      const mainContent = document.getElementById('mainContent');
      if (mainContent) {
        mainContent.innerHTML = content[page] || "<p>Konten tidak ditemukan.</p>";
      } else {
        console.error('Elemen #mainContent tidak ditemukan');
      }
    }
  </script>
</body>
</html>

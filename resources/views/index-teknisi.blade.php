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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<body>
  <!-- Verifikasi Session -->
  @if (!session('login_teknisi'))
  <script>
    alert("Anda harus login terlebih dahulu.");
    window.location.href = "{{ route('login.teknisi') }}";
  </script>
  @endif

  <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
      <!-- Menu -->
      <aside id="layout-menu" class="d-none d-lg-block p-3 bg-menu-theme" style="width: 250px; min-height: 100vh;">
        <div class="app-brand demo">
          <a href="index.html" class="app-brand-link">
            <span class="app-brand-text demo menu-text fw-bolder ms-2">Teknisi</span>
          </a>
        </div>
        <ul class="list-unstyled">
          <!-- Update the sidebar items -->
          <li><a href="#" class="d-block p-2" onclick="showContent('dataPelanggan')"><i class="menu-icon bx bx-user"></i>Data Pelanggan</a></li>
          <li><a href="#" class="d-block p-2" onclick="showContent('lembarPengujian')"><i class="menu-icon bx bx-calendar"></i>Lembar Pengujian</a></li>
          <li><a href="#" class="d-block p-2" onclick="showContent('invoiceLab')"><i class="menu-icon bx bx-file"></i>Invoice Lab</a></li>
          <li><a href="#" class="d-block p-2" onclick="showContent('invoiceLapangan')"><i class="menu-icon bx bx-download"></i>Invoice Lapangan</a></li>
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
                <!-- Update navbar items -->
                <li class="nav-item"><a class="nav-link" href="#" onclick="showContent('dataPelanggan')"><i class="menu-icon bx bx-user"></i>Data Pelanggan</a></li>
                <li class="nav-item"><a class="nav-link" href="#" onclick="showContent('lembarPengujian')"><i class="menu-icon bx bx-calendar"></i>Lembar Pengujian</a></li>
                <li class="nav-item"><a class="nav-link" href="#" onclick="showContent('invoiceLab')"><i class="menu-icon bx bx-file"></i>Invoice Lab</a></li>
                <li class="nav-item"><a class="nav-link" href="#" onclick="showContent('invoiceLapangan')"><i class="menu-icon bx bx-download"></i>Invoice Lapangan</a></li>
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
           
            <div class="flex-grow-1 p-3" id="mainContent">
              <!-- Konten dinamis akan ditampilkan di sini -->
              <h1>Selamat datang di Dashboard Teknisi</h1>
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
    // JavaScript to display content based on sidebar clicks

    // Pastikan konten telah dimuat sebelum mencoba mengakses elemen
    function showContent(page) {
        const content = {
            dataPelanggan: `<h2>Data Pelanggan</h2>
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
            lembarPengujian: `<h2>Lembar Pengujian</h2>
          
              <form id="lembarPengujianForm" action="{{ route('lembar-pengujian.upload') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="mb-3">
                      <label for="file_pdf" class="form-label">Upload PDF</label>
                      <input type="file" class="form-control" id="file_pdf" name="file_pdf" accept="application/pdf" required>
                  </div>
                  <button type="submit" class="btn btn-primary">Upload PDF</button>
              </form>

              <h3>Data Pengujian</h3>
<table class="table table-striped">
  <thead>
    <tr>
      <th>#</th>
      <th>File Name</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($pdfFiles as $index => $file)
      <tr>
        <td>{{ $index + 1 }}</td>
        <td>
          <a href="{{ asset('storage/' . $file->file_path) }}" target="_blank">
            {{ basename($file->file_path) }}
          </a>
        </td>
        <td>
          <!-- Kirim Button -->
          @if(!$file->is_sent) <!-- Check if not sent -->
            <form action="{{ route('lembarPengujian.kirim', $file->id) }}" method="POST" style="display:inline;">
              @csrf
              <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Apakah anda yakin ingin mengirim data ke pelapor?')">
                Kirim
              </button>
            </form>
          @else
            <!-- If data is sent, disable the delete button -->
            <button class="btn btn-secondary btn-sm" disabled>Data Sudah Dikirim</button>
          @endif

          <!-- Delete Button -->
          @if(!$file->is_sent) <!-- Allow delete only if not sent -->
            <form action="{{ route('lembarPengujian.destroy', $file->id) }}" method="POST" style="display:inline;">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin ingin menghapus file?')">
                Delete
              </button>
            </form>
          @else
            <!-- If data is sent, disable the delete button -->
            <button class="btn btn-secondary btn-sm" disabled>Hapus</button>
          @endif
        </td>
      </tr>
    @endforeach
  </tbody>
</table>

`,
            invoiceLab: ` <h2>Invoice Lab</h2>
        <table class="table table-striped">
          <thead>
            <tr>
              <th>No</th>
              <th>Excel Lab</th>
              <th>Teknisi</th>
              <th>Created At</th>
     
            </tr>
          </thead>
          <tbody>
            @foreach($invoiceLabs as $index => $invoice)
              <tr>
                <td>{{ $index + 1 }}</td>
                <td><a href="{{ asset('storage/' . $invoice->excel_lab) }}" target="_blank">{{ basename($invoice->excel_lab) }}</a></td>
                <td>{{ $invoice->teknisi }}</td>
                <td>{{ $invoice->created_at->format('d M Y H:i') }}</td>
              
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
              <th>Teknisi</th>
              <th>Created At</th>
          
            </tr>
          </thead>
          <tbody>
            @foreach($invoiceLapangan as $index => $invoice)
              <tr>
                <td>{{ $index + 1 }}</td>
                <td><a href="{{ asset('storage/' . $invoice->excel_lab) }}" target="_blank">{{ basename($invoice->excel_lab) }}</a></td>
                <td>{{ $invoice->teknisi }}</td>
                <td>{{ $invoice->created_at->format('d M Y H:i') }}</td>
           
              </tr>
            @endforeach
          </tbody>
        </table>`
        };

        const mainContent = document.getElementById('mainContent');
        if (mainContent) {
            mainContent.innerHTML = content[page] || "<p>Konten tidak ditemukan.</p>";
        } else {
            console.error('Elemen #mainContent tidak ditemukan');
        }
    }
    @if (session('success-simpan-pengujian'))
            Swal.fire({
                title: "Berhasil",
                text: "Data pengujian berhasil di simpan",
                icon: "success",
                confirmButtonColor: "#28a745",
            }).then(() => {
                showContent('lembarPengujian');
            });
        @endif
    @if (session('success-kirim-pelaporan'))
            Swal.fire({
                title: "Berhasil",
                text: "Data pengujian berhasil di kirim",
                icon: "success",
                confirmButtonColor: "#28a745",
            }).then(() => {
                showContent('lembarPengujian');
            });
        @endif
        @if (session('success-hapus-pengujian'))
            Swal.fire({
                title: " Berhasil",
                text: "Data Pengujian telah di hapus",
                icon: "warning",
                confirmButtonColor: "#dc3545",
            }).then(() => {
              showContent('lembarPengujian');
            });
        @endif      
  </script>
</body>
</html>

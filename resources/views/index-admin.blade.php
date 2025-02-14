<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
  <title>Dashboard - Bookkeeping Management System</title>
  <link rel="stylesheet" href="/dashboard/assets/vendor/fonts/boxicons.css" />
  <link rel="stylesheet" href="/dashboard/assets/vendor/css/core.css" />
  <link rel="stylesheet" href="/dashboard/assets/vendor/css/theme-default.css" />
  <link rel="stylesheet" href="/dashboard/assets/css/demo.css" />
  <script src="/dashboard/assets/vendor/js/helpers.js"></script>
</head>
<style>
  body {
    background-color: #f8f9fa;
  }
  #layout-menu {
    background-color: #ffffff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    border-right: 1px solid #e9ecef;
  }
  #layout-menu h4 {
    font-size: 1.5rem;
    font-weight: bold;
    color: #343a40;
    margin-bottom: 1rem;
  }
  #layout-menu ul {
    padding: 0;
  }
  #layout-menu ul li a {
    display: flex;
    align-items: center;
    font-size: 1rem;
    color: #495057;
    padding: 0.75rem 1rem;
    text-decoration: none;
    border-radius: 0.375rem;
    transition: background-color 0.2s ease;
  }
  #layout-menu ul li a:hover {
    background-color: #f1f3f5;
  }
  #layout-menu ul li a .menu-icon {
    margin-right: 0.75rem;
    font-size: 1.25rem;
  }
  .container {
    padding: 2rem;
  }
  .navbar {
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  }
  .navbar-toggler {
    border: none;
  }
  .btn-danger {
    background-color: #dc3545;
    border-color: #dc3545;
  }
  .btn-danger:hover {
    background-color: #bb2d3b;
    border-color: #bb2d3b;
  }
  input[name="_method"] {
    display: none;
  }
</style>
<body>
  <!-- Verifikasi Session -->
  @if (!session('login_admin'))
  <script>
    alert("Anda harus login terlebih dahulu.");
    window.location.href = "{{ route('login.admin') }}";
  </script>
  @endif

  <nav class="navbar navbar-expand-lg navbar-light d-lg-none">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item"><a class="nav-link" href="#" onclick="showContent('dataAdministrasi')"><i class="menu-icon bx bx-printer"></i>Data Administrasi</a></li>
          <li class="nav-item"><a class="nav-link" href="#" onclick="showContent('dataPelanggan')"><i class="menu-icon bx bx-key"></i>Data Pelanggan</a></li>
          <li class="nav-item">
            <form action="{{ route('logout') }}" method="POST">
              @csrf
              <button type="submit" class="menu-link bg-transparent" style="border:none;">
                <i class="menu-icon tf-icons bx bx-log-out"></i>Logout
              </button>
            </form>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
      <!-- Sidebar -->
      <aside id="layout-menu" class="d-none d-lg-block bg-menu-theme p-3" style="width: 250px; min-height: 100vh;">
        <div class="app-brand demo">
          <a href="#" class="app-brand-link">
            <span class="app-brand-text demo menu-text fw-bolder ms-2">Admin</span>
          </a>
        </div>

        <ul class="list-unstyled mt-2">
          <li>
            <a href="#" class="d-block p-2" onclick="showContent('dataAdministrasi')">
              <i class="menu-icon bx bx-printer"></i>Data Administrasi
            </a>
          </li>
          <li>
            <a href="#" class="d-block p-2" onclick="showContent('dataPelanggan')">
              <i class="menu-icon bx bx-key"></i>Data Pelanggan
            </a>
          </li>
          <li>
            <form action="{{ route('logout') }}" method="POST">
              @csrf
              <button type="submit" class="menu-link w-100 text-start bg-transparent" style="border:none;">
                <i class="menu-icon tf-icons bx bx-log-out"></i>Logout
              </button>
            </form>
          </li>
        </ul>
      </aside>

      <!-- Main Content -->
      <div class="flex-grow-1 p-3" id="mainContent">
        <h1>Selamat Datang di Halaman Admin</h1>
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
    document.addEventListener("DOMContentLoaded", function() {

    const urlParams = new URLSearchParams(window.location.search);
    const startDate = urlParams.get('start_date');
    const endDate = urlParams.get('end_date');

   
    if (startDate && endDate) {
        console.log('Filtering data berdasarkan tanggal:', startDate, 'sampai', endDate);
     
        showContent('dataPelanggan');
    }

});

    function showContent(page) {
      const content = {
        dataAdministrasi: `
          <div class="container">
        <h2>Data Administrasi</h2>

        <!-- Form untuk upload file PDF -->
        <form action="{{ route('data.administrasi.upload') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="uploadFile" class="form-label">Pilih File PDF</label>
                <input type="file" class="form-control" id="uploadFile" name="file" required>
                <small class="form-text text-muted">* Upload dalam format PDF, maksimal 10MB.</small>
            </div>
            <button type="submit" class="btn btn-primary">Upload</button>
        </form>

        <!-- Menampilkan pesan sukses jika file berhasil di-upload -->
        @if (session('success'))
            <div class="alert alert-success mt-3">
                {{ session('success') }}
            </div>
        @endif

        <!-- Daftar File yang Diupload -->
        <h3 class="mt-4">Daftar File Administrasi yang Di-upload</h3>
        <ul class="list-group">
            @foreach ($files as $file)
                <li class="list-group-item">
                  
                    <a href="{{ asset('storage/' . $file->file_path) }}" target="_blank">
                        {{ basename($file->file_path) }}
                  
                    </a>
                                <small class="text-muted">
                <!-- Menampilkan tanggal upload -->
                - Diupload pada: {{ $file->created_at->format('d M Y H:i') }}
            </small>
                </li>
            @endforeach
        </ul>
    </div>`,
        dataPelanggan: `
           <div class="container">
            <h2>Data Pelanggan</h2>
            
            <!-- Form untuk input data pelanggan -->
            <form action="{{ route('data.pelanggan.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="no_invoice" class="form-label">No Invoice</label>
                    <input type="text" class="form-control" id="no_invoice" name="no_invoice" required>
                </div>
                <div class="mb-3">
                    <label for="nama_perusahaan" class="form-label">Nama Perusahaan</label>
                    <input type="text" class="form-control" id="nama_perusahaan" name="nama_perusahaan" required>
                </div>
                <div class="mb-3">
                    <label for="nama_proyek" class="form-label">Nama Proyek</label>
                    <input type="text" class="form-control" id="nama_proyek" name="nama_proyek" required>
                </div>
                <div class="mb-3">
                    <label for="permohonan" class="form-label">Permohonan</label>
                    <input type="text" class="form-control" id="permohonan" name="permohonan" required>
                </div>
                <div class="mb-3">
                    <label for="tanggal_datang" class="form-label">Tanggal Datang</label>
                    <input type="date" class="form-control" id="tanggal_datang" name="tanggal_datang" required>
                </div>
               <div class="mb-3">
    <label for="teknisi" class="form-label">Teknisi</label>
    <select class="form-control" id="teknisi" name="teknisi" required>
        <option value="" disabled selected>Pilih Teknisi</option>
        <option value="TEKNISI A">TEKNISI A</option>
        <option value="TEKNISI B">TEKNISI B</option>
        <option value="TEKNISI C">TEKNISI C</option>
        <option value="TEKNISI D">TEKNISI D</option>
        <option value="TEKNISI E">TEKNISI E</option>
        <option value="TEKNISI F">TEKNISI F</option>
        <option value="TEKNISI G">TEKNISI G</option>
        <option value="TEKNISI H">TEKNISI H</option>

    </select>
</div>

                <button type="submit" class="btn btn-primary">Tambah Data</button>
            </form>

<h3 class="mt-4">Daftar Data Pelanggan</h3>
<!-- Tabel Data Pelanggan -->
 <form action="{{ route('data.pelanggan.filter') }}" method="GET" class="mb-4">
                  @csrf
                  <div class="row">
                      <div class="col-md-5">
                          <label for="start_date" class="form-label">Tanggal Mulai</label>
                          <input type="date" class="form-control" id="start_date" name="start_date" required>
                      </div>
                      <div class="col-md-5">
                          <label for="end_date" class="form-label">Tanggal Akhir</label>
                          <input type="date" class="form-control" id="end_date" name="end_date" required>
                      </div>
                      <div class="col-md-2 d-flex align-items-end">
                          <button type="submit" class="btn btn-primary">Filter</button>
                      </div>
                  </div>
              </form>
                  <form action="{{ url('data-pelanggan/export') }}" method="GET">
                           <input type="hidden" name="start_date" value="{{ request('start_date') }}">
    <input type="hidden" name="end_date" value="{{ request('end_date') }}">
    <button type="submit" class="btn btn-success {{ !request('start_date') || !request('end_date') ? 'disabled' : '' }}">
        Export to Excel
    </button>
</form>
<table class="table table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>No Invoice</th>
            <th>Nama Perusahaan</th>
            <th>Nama Proyek</th>
            <th>Permohonan</th>
            <th>Tanggal Datang</th>
            <th>Teknisi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($pelanggan as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->no_invoice }}</td>
                <td>{{ $item->nama_perusahaan }}</td>
                <td>{{ $item->nama_proyek }}</td>
                <td>{{ $item->permohonan }}</td>
                <td>{{ \Carbon\Carbon::parse($item->tanggal_datang)->format('d M Y') }}</td>
                <td>{{ $item->teknisi }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

          </div>
        `,
      };

      document.getElementById('mainContent').innerHTML = content[page];

    }
    @if (session('success-simpan-pelanggan'))
    alert("Berhasil Menyimpan Pelanggan ");
    showContent('dataPelanggan');
@endif
    @if (session('success-mengupload-file'))
    alert("Berhasil Menguploadfile ");
    showContent('dataAdministrasi');
@endif
    @if (session(key: 'filter-tanggal'))
    alert("Menfilter Tanggal")
    showContent('dataPelanggan');
@endif

  </script>
</body>
</html>

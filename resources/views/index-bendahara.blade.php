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
</style>
<body>
  <!-- Verifikasi Session -->
  @if (!session('login_bendahara'))
  <script>
    alert("Anda harus login terlebih dahulu.");
    window.location.href = "{{ route('login.bendahara') }}";
  </script>
  @endif

  <nav class="navbar navbar-expand-lg navbar-light d-lg-none">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item"><a class="nav-link" href="#" onclick="showContent('dataAdministrasi')"><i class="menu-icon bx bx-download"></i>Data Administrasi</a></li>
          <li class="nav-item"><a class="nav-link" href="#" onclick="showContent('invoice')"><i class="menu-icon bx bx-notepad"></i>Invoice</a></li>
          <li class="nav-item"><a class="nav-link" href="#" onclick="showContent('kas')"><i class="menu-icon bx bx-notepad"></i>Buat KAS</a></li>
          <li class="nav-item"><a class="nav-link" href="#" onclick="showContent('kwitansi')"><i class="menu-icon bx bx-file"></i>Buat Kwitansi</a></li>
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
            <span class="app-brand-text demo menu-text fw-bolder ms-2">Bendahara</span>
          </a>
        </div>

        <ul class="list-unstyled mt-2">
          <li>
            <a href="#" class="d-block p-2" onclick="showContent('dataAdministrasi')">
              <i class="menu-icon bx bx-download"></i>Data Administrasi
            </a>
          </li>
          <li>
            <a href="#" class="d-block p-2" onclick="showContent('invoice')">
              <i class="menu-icon bx bx-notepad"></i>Daftar Invoice
            </a>
          </li>
          <li>
            <a href="#" class="d-block p-2" onclick="showContent('kas')">
              <i class="menu-icon bx bx-notepad"></i>Buat KAS
            </a>
          </li>
          <li>
            <a href="#" class="d-block p-2" onclick="showContent('kwitansi')">
              <i class="menu-icon bx bx-file"></i>Buat Kwitansi
            </a>
          </li>
          <li>
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
      <div class="flex-grow-1 p-3" id="mainContent">
        <h1>Selamat Datang di Halaman Bendahara</h1>
      </div>
  <!-- Modal Edit Invoice -->
<div class="modal fade" id="editInvoiceModal" tabindex="-1" aria-labelledby="editInvoiceModalLabel" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="editInvoiceModalLabel">Edit Invoice</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <form id="editInvoiceForm" method="POST" action="{{ route('administrasi.update', '') }}" id="editForm">
                  @csrf
                  <input type="hidden" name="id" id="editInvoiceId">
                  
                  <div class="mb-3">
                      <label for="editNoInvoice" class="form-label">No Invoice</label>
                      <input type="text" class="form-control" id="editNoInvoice" name="no_invoice" required>
                  </div>
                  <div class="mb-3">
                      <label for="editNamaPerusahaan" class="form-label">Nama Perusahaan</label>
                      <input type="text" class="form-control" id="editNamaPerusahaan" name="nama_perusahaan" required>
                  </div>
                  <div class="mb-3">
                      <label for="editNamaProyek" class="form-label">Nama Proyek</label>
                      <input type="text" class="form-control" id="editNamaProyek" name="nama_proyek" required>
                  </div>
                  <div class="mb-3">
                      <label for="editPermohonan" class="form-label">Permohonan</label>
                      <input type="text" class="form-control" id="editPermohonan" name="permohonan" required>
                  </div>
                  <div class="mb-3">
                      <label for="editTanggalDatang" class="form-label">Tanggal Datang</label>
                      <input type="date" class="form-control" id="editTanggalDatang" name="tanggal_datang" required>
                  </div>
                  <div class="mb-3">
                      <label for="editTanggalPembayaranVA" class="form-label">Tanggal Pembayaran ke VA</label>
                      <input type="date" class="form-control" id="editTanggalPembayaranVA" name="tanggal_pembayaran_va" required>
                  </div>
                  <div class="mb-3">
                      <label for="editTotalHarga" class="form-label">Total Harga</label>
                      <input type="number" class="form-control" id="editTotalHarga" name="total_harga" required>
                  </div>
                  <div class="mb-3">
                      <label for="editUangMuka" class="form-label">Uang Muka</label>
                      <input type="number" class="form-control" id="editUangMuka" name="uang_muka" required>
                  </div>
                  <div class="mb-3">
                      <label for="editSisa" class="form-label">Sisa</label>
                      <input type="number" class="form-control" id="editSisa" name="sisa" required>
                  </div>
                  
                  <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
              </form>
          </div>
      </div>
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
  <!-- JavaScript -->
 
 

</body>
</html>

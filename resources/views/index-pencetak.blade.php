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
</head>

<body>
  <!-- Verifikasi Session -->
  @if (!session('login_pencetak'))
  <script>
    alert("Anda harus login terlebih dahulu.");
    window.location.href = "{{ route('login.pencetak') }}";
  </script>
  @endif

  <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
      <!-- Menu -->
      <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
        <div class="app-brand demo">
          <a href="index.html" class="app-brand-link">
            <span class="app-brand-text demo menu-text fw-bolder ms-2">Pencetak</span>
          </a>
          <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
          </a>
        </div>
        <div class="menu-inner-shadow"></div>
        <ul class="menu-inner py-1">
          <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link">
              <i class="menu-icon tf-icons bx bx-printer"></i>
              <div>Laporan Siap Cetak</div>
            </a>
          </li>
          <li class="menu-item" @if(!session('show_generate_key_menu')) style="display: none;" @endif>
            <a href="javascript:void(0);" class="menu-link" onclick="showGenerateKeyForm()">
              <i class="menu-icon tf-icons bx bx-key"></i>
              <div>Generate Key</div>
            </a>
          </li>
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
      <!-- / Menu -->
      
      <div class="container mt-2" id="mainContent">
        <h2>Kwitansi Siap Cetak</h2>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No Invoice</th>
                    <th>Supplier</th>
                    <th>Proyek</th>
                    <th>Total Tagihan</th>
                    <th>Jenis Pembayaran</th>
                    <th>Untuk Pembayaran</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kwitansi_acc as $kwitansi)
                    <tr>
                        <td>{{ $kwitansi->nomor_invoice }}</td>
                        <td>{{ $kwitansi->supplier }}</td>
                        <td>{{ $kwitansi->proyek }}</td>
                        <td>Rp. {{ number_format($kwitansi->total_tagihan, 2) }}</td>
                        <td>{{ $kwitansi->jenis_pembayaran }}</td>
                        <td>{{ $kwitansi->untuk_pembayaran }}</td>
                        <td>
                          <a href="{{ route('kwitansi.detail', $kwitansi->id) }}" class="btn btn-primary">Cetak</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
  </div>

  <script src="/dashboard/assets/vendor/libs/jquery/jquery.js"></script>
  <script src="/dashboard/assets/vendor/libs/popper/popper.js"></script>
  <script src="/dashboard/assets/vendor/js/bootstrap.js"></script>
  <script src="/dashboard/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
  <script src="/dashboard/assets/vendor/js/menu.js"></script>
  <script src="/dashboard/assets/js/main.js"></script>

</body>
</html>

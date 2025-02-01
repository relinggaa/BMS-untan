<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
  <title>Dashboard - Bookkeeping Management System</title>
  <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="/dashboard/assets/vendor/fonts/boxicons.css" />
  <link rel="stylesheet" href="/dashboard/assets/vendor/css/core.css" />
  <link rel="stylesheet" href="/dashboard/assets/vendor/css/theme-default.css" />
  <link rel="stylesheet" href="/dashboard/assets/css/demo.css" />
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
</head>
<body>
  @if (!session('login_admin'))
  <script>
    alert("Anda harus login terlebih dahulu.");
    window.location.href = "{{ route('login.admin') }}";
  </script>
  @endif
  
  <div class="d-flex">
    <!-- Sidebar (Hanya Tampil di Desktop) -->
    <aside id="layout-menu" class="d-none d-lg-block bg-menu-theme p-3" style="width: 250px; min-height: 100vh;">
      <a href="index.html" class="app-brand-link">
        <span class="app-brand-text demo menu-text fw-bolder ms-2">Admin</span>
      </a>
      <ul class="list-unstyled">
        <li><a href="#" class="d-block p-2"><i class="menu-icon bx bx-printer"></i>Laporan Siap Cetak</a></li>
        <li><a href="#" class="d-block p-2"><i class="menu-icon bx bx-cloud-download"></i>Upload Data Excel</a></li>
        <li><a href="#" class="d-block p-2"><i class="menu-icon bx bx-data"></i>Data Administrasi</a></li>
        <form action="{{ route('logout') }}" method="POST">
          @csrf
          <button type="submit" class="menu-link w-100 text-start bg-transparent" style="border:none;">
            <i class="menu-icon tf-icons bx bx-log-out"></i>
            <div>Logout</div>
          </button>
        </form>
      </ul>
    </aside>
    
    <!-- Main Content -->
    <div class="flex-grow-1">
      <!-- Navbar (Tampil di Mobile) -->
      <nav class="navbar navbar-expand-lg navbar-light bg-light d-lg-none">
        <div class="container-fluid">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
              <li class="nav-item"><a class="nav-link" href="#"><i class="menu-icon bx bx-printer"></i>Laporan Siap Cetak</a></li>
              <li class="nav-item"><a class="nav-link" href="#"><i class="menu-icon bx bx-cloud-download"></i>Upload Data Excel</a></li>
              <li class="nav-item"><a class="nav-link" href="#"><i class="menu-icon bx bx-data"></i>Data Administrasi</a></li>
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
      
      <div class="container mt-4">
        <h1>Berhasil Login Admin</h1>
      </div>
    </div>
  </div>


  <script src="/dashboard/assets/vendor/libs/jquery/jquery.js"></script>
  <script src="/dashboard/assets/vendor/libs/popper/popper.js"></script>
  <script src="/dashboard/assets/vendor/js/bootstrap.js"></script>
  <script src="/dashboard/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
  <script src="/dashboard/assets/vendor/js/menu.js"></script>
  <script src="/dashboard/assets/js/main.js"></script>
</body>
</html>

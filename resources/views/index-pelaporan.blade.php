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
          <li><a href="#" class="d-block p-2"><i class="menu-icon bx bx-user"></i>Tampilkan Data</a></li>
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
                <li class="nav-item"><a class="nav-link" href="#"><i class="menu-icon bx bx-pencil"></i>Tampilkan Data</a></li>
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
            <h1>Berhasil Login Pelaporan</h1>
         

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

</body>
</html>

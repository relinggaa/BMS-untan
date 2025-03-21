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
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
  <script src="/dashboard/assets/vendor/js/helpers.js"></script>
  <script src="/dashboard/assets/js/config.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <style>
      body {
        background-color: #f8f9fa;
      }

      #layout-menu {
        background-color: #ffffff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        border-right: 1px solid #e9ecef;
        position: fixed;
        height: 100%;
        top: 0;
        left: 0;
        z-index: 999;
      }

      .menu-link {
        display: flex;
        align-items: center;
        font-size: 1rem;
        color: #495057;
        padding: 0.75rem 1rem;
        text-decoration: none;
        border-radius: 0.375rem;
        transition: background-color 0.2s ease;
      }

      .menu-link:hover {
        background-color: #f1f3f5;
      }

      .menu-link .menu-icon {
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


      .layout-wrapper {
        display: flex;
      }

      .layout-container {
        margin-left: 250px;
        padding: 1rem;
        width: 100%;
      }

    
      #mainContent {
        margin-left: 50px;
        padding-left: 1rem;
        z-index: 10;
      }
  </style>
</head>

<body>

  @if (!session('login_penyelia'))
  <script>
    alert("Anda harus login terlebih dahulu.");
    window.location.href = "{{ route('login.penyelia') }}";
  </script>
  @endif

  <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
      <!-- Menu -->
      <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
        <div class="app-brand demo">
          <a href="index.html" class="app-brand-link">
            <span class="app-brand-text demo menu-text fw-bolder ms-2">Penyelia</span>
          </a>
          <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
          </a>
        </div>
        <div class="menu-inner-shadow"></div>
        <ul class="menu-inner py-1">
          <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link" onclick="showContent('laporan')">
              <i class="menu-icon tf-icons bx bx-printer"></i>
              <div>Laporan</div>
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

      <!-- Main Content -->
      <div class="flex-grow-1 p-5" id="mainContent">
        <h1>Selamat Datang di Dashboard Penyelia</h1>
        <p>Silakan pilih menu di sisi kiri untuk melanjutkan.</p>
      </div>
      <!-- / Content -->
    </div>
  </div>
  <div class="modal fade" id="addCatatanModal" tabindex="-1" aria-labelledby="addCatatanModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCatatanModalLabel">Tambahkan Catatan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="catatanForm" method="POST">
                    @csrf
                    <input type="hidden" name="laporan_id" id="laporan_id">
                    <div class="mb-3">
                        <label for="catatan" class="form-label">Catatan</label>
                        <textarea class="form-control" id="catatan" name="catatan" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan Catatan</button>
                </form>
            </div>
        </div>
    </div>
</div>


  <script>
    function showContent(page) {
      const content = {
        laporan: `
   <h3>Upload Laporan</h3>
<table class="table table-bordered table-striped table-hover">
    <thead>
        <tr>
            <th>File Name</th>
            <th>Catatan Laporan</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($laporanPenyelia as $file)
        <tr>
            <td><a href="{{ asset('storage/' . $file->file_path) }}" target="_blank">{{ basename($file->file_path) }}</a></td>
            <td>
                @foreach ($file->laporan->catatan as $catatan)
                    <p>{{ $catatan->catatan }}</p>
                    <small class="text-muted">Posted on: {{ $catatan->created_at->format('d M Y H:i') }}</small>
                @endforeach
            </td>
            <td>
                <!-- Button to Add Catatan -->
                <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#addCatatanModal" onclick="setLaporanId({{ $file->id }})">
                    Tambahkan Catatan
                </button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>


        `,
      };

      const mainContent = document.getElementById('mainContent');
      if (mainContent) {
        mainContent.innerHTML = content[page] || "<p>Konten tidak ditemukan.</p>";
      } else {
        console.error('Elemen #mainContent tidak ditemukan');
      }
    }
    function setLaporanId(laporanId) {
        document.getElementById('laporan_id').value = laporanId;
    }
    @if (session('success-buat-catatan'))
            Swal.fire({
                title: "Catatan Berhasil Di Buat!",
                text: "Berhasil Membuat Catatan",
                icon: "success",
                confirmButtonColor: "#28a745",
            }).then(() => {
                showContent('laporan');
            });
        @endif
  </script>

  <script src="/dashboard/assets/vendor/libs/jquery/jquery.js"></script>
  <script src="/dashboard/assets/vendor/libs/popper/popper.js"></script>
  <script src="/dashboard/assets/vendor/js/bootstrap.js"></script>
  <script src="/dashboard/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
  <script src="/dashboard/assets/vendor/js/menu.js"></script>
  <script src="/dashboard/assets/js/main.js"></script>

</body>
</html>

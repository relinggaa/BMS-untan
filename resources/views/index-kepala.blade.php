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
  @if (!session('login_kepala'))
  <script>
    alert("Anda harus login terlebih dahulu.");
    window.location.href = "{{ route('login.kepala') }}";
  </script>
  @endif
  <nav class="navbar navbar-expand-lg navbar-light d-lg-none">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item"><a class="nav-link" href="#"><i class="menu-icon bx bx-printer"></i>Laporan Siap Cetak</a></li>
          <li class="nav-item" @if(!session('show_generate_key_menu')) style="display: none;" @endif>
            <a class="nav-link" href="#" onclick="showGenerateKeyForm()"><i class="menu-icon bx bx-key"></i>Generate Key</a>
          </li>
          <li class="nav-item"><a class="nav-link" href="#"><i class="menu-icon bx bx-cloud-download"></i>Backup All Data</a></li>
          <li class="nav-item"><a class="nav-link" href="#"><i class="menu-icon bx bx-file"></i>Data Laporan</a></li>
          <li class="nav-item"><a class="nav-link" href="#"><i class="menu-icon bx bx-receipt"></i>Data Bukti Pembayaran</a></li>
          <li class="nav-item">
            <form action="{{ route('logout') }}" method="POST">
              @csrf
              <button type="submit" class="menu-link w-100 text-start bg-transparent" style="border:none;">
                <i class="menu-icon bx bx-log-out"></i>Logout
              </button>
            </form>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
      <!-- Menu -->
      <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
        <div class="app-brand demo">
          <a href="index.html" class="app-brand-link">
            <span class="app-brand-text demo menu-text fw-bolder ms-2">Kepala Lab</span>
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
            <a href="javascript:void(0);" class="menu-link">
              <i class="menu-icon tf-icons bx bx-cloud-download"></i>
              <div>Backup All Data</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link">
              <i class="menu-icon tf-icons bx bx-file"></i>
              <div>Data Laporan</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link">
              <i class="menu-icon tf-icons bx bx-receipt"></i>
              <div>Data Bukti Pembayaran</div>
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
      
      
      <div class="layout-page">
        <div class="content-wrapper">
          <!-- Content -->
          <div id="generateKeyForm" style="display:none; padding:20px;">
         
            <h3>Pilih Role</h3>
            @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
          @endif
          @if ($errors->any())
                <div class="alert alert-danger">
              @foreach ($errors->all() as $error)
                  <p>{{ $error }}</p>
              @endforeach
          </div>
          @endif
            <form action="{{ route('generate.key') }}" method="POST">
              @csrf
              <div id="generate" class="mb-3">
                <label for="roleSelect" class="form-label">Role</label>
                <select class="form-control" id="roleSelect" name="role" required>
                  <option value="Admin">Admin</option>
                  <option value="Bendahara">Bendahara</option>
                  <option value="Teknisi">Teknisi</option>
                  <option value="Pelapor">Pelapor</option>
                  <option value="Penyelia">Penyelia</option>
                  <option value="Pencetak">Pencetak</option>
                  <option value="Kepala Lab">Kepala Lab</option>
                </select>
              </div>
              <div class="mb-3">
                <label for="generatedKey" class="form-label">Generated Key</label>
                <input type="text" class="form-control" id="generatedKey" name="key" readonly required>
              </div>
              <button type="button" class="btn btn-primary" onclick="generateKey()">Generate Key</button>
              <button type="submit" class="btn btn-success" id="saveKeyButton" style="display:none;">Simpan</button>
              <button type="button" class="btn btn-secondary" onclick="hideGenerateKeyForm()">Cancel</button>
            </form>
          </div>
      <div id="keyTableContainer" style="display:none; padding:20px;">
    <h3>Daftar Key</h3>
    <table class="table table-striped" id="keyTable">
      <thead>
        <tr>
          <th>ID</th>
          <th>Role</th>
          <th>Key</th>
          <th>Created At</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($keys as $key)
          <tr>
            <td>{{ $key->id }}</td>
            <td>{{ $key->role }}</td>
            <td>{{ $key->key }}</td>
            <td>{{ $key->created_at }}</td>
            <td>
      
              <form action="{{ route('keys.destroy', $key->id) }}" method="POST" style="display:inline;">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus key ini?')">Hapus</button>
              </form>
          </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
        </div>
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
    // Fungsi untuk membaca query string dari URL
    function getQueryParam(param) {
        const urlParams = new URLSearchParams(window.location.search);
        return urlParams.get(param);
    }

    // cek menu generate
    window.onload = function() {
        const menu = getQueryParam('menu');
        if (menu === 'generate-key') {
            showGenerateKeyForm(); 
        }
    }
    function showGenerateKeyForm() {
      document.getElementById('generateKeyForm').style.display = 'block';
      document.getElementById('keyTableContainer').style.display = 'block';
    }

    function hideGenerateKeyForm() {
      document.getElementById('generateKeyForm').style.display = 'none';
      document.getElementById('keyTableContainer').style.display = 'none';
    }

    function generateRandomString(length) {
      const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
      let result = '';
      for (let i = 0; i < length; i++) {
        result += characters.charAt(Math.floor(Math.random() * characters.length));
      }
      return result;
    }
    
    function generateKey() {
      const keyInput = document.getElementById('generatedKey'); // Input untuk key
      const saveButton = document.getElementById('saveKeyButton'); // Tombol Simpan

      // Generate key random
      keyInput.value = generateRandomString(6);

      // Tampilkan tombol simpan
      saveButton.style.display = 'inline-block';
    }
    
  </script>
</body>
</html>

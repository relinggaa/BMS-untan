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
          <li class="nav-item"><a class="nav-link" href="#" onclick="showContent('laporanSiapCetak')"><i class="menu-icon bx bx-printer"></i>Laporan Siap Cetak</a></li>
          <li class="nav-item"><a class="nav-link" href="#" onclick="showContent('generateKey')"><i class="menu-icon bx bx-key"></i>Generate Key</a></li>
          <li class="nav-item"><a class="nav-link" href="#" onclick="showContent('backupData')"><i class="menu-icon bx bx-cloud-download"></i>Backup All Data</a></li>
          <li class="nav-item"><a class="nav-link" href="#" onclick="showContent('dataLaporan')"><i class="menu-icon bx bx-file"></i>Data Laporan</a></li>
          <li class="nav-item"><a class="nav-link" href="#" onclick="showContent('dataPengujian')"><i class="menu-icon bx bx-file"></i>Data Pengujian</a></li>
          <li class="nav-item"><a class="nav-link" href="#" onclick="showContent('dataBuktiPembayaran')"><i class="menu-icon bx bx-receipt"></i>Data Bukti Pembayaran</a></li>
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
            <span class="app-brand-text demo menu-text fw-bolder ms-2">Kepala Lab</span>
          </a>
        </div>

        <ul class="list-unstyled mt-2">
          <li>
            <a href="#" class="d-block p-2" onclick="showContent('laporanSiapCetak')">
              <i class="menu-icon bx bx-printer"></i>Laporan Siap Cetak
            </a>
          </li>
          <li>
            <a href="#" class="d-block p-2" onclick="showContent('generateKey')">
              <i class="menu-icon bx bx-key"></i>Generate Key
            </a>
          </li>
          <li>
            <a href="#" class="d-block p-2" onclick="showContent('dataKwintasi')">
              <i class="menu-icon bx bx-cloud-download"></i>Data kwintansi
            </a>
          </li>
          <li>
            <a href="#" class="d-block p-2" onclick="showContent('dataLaporan')">
              <i class="menu-icon bx bx-file"></i>Data Laporan
            </a>
          </li>
          <li>
            <a href="#" class="d-block p-2" onclick="showContent('dataPengujian')">
              <i class="menu-icon bx bx-file"></i>Data Pengujian
            </a>
          </li>
          <li>
            <a href="#" class="d-block p-2" onclick="showContent('dataBuktiPembayaran')">
              <i class="menu-icon bx bx-receipt"></i>Data Bukti Pembayaran
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
        <h1>Selamat Datang di Halaman Kepala Lab</h1>
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
    function showContent(page) {
      
      const content = {
        laporanSiapCetak: '<h2>Laporan Siap Cetak</h2><p>Konten laporan siap cetak di sini.</p>',
        generateKey: `
        <h2>Generate Key</h2>
        <form action="{{ route('generate.key') }}" method="POST">
          @csrf
          <div class="mb-3">
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
          <button type="submit" class="btn btn-success" style="display:none;" id="saveKeyButton">Simpan</button>
        </form>

        <h3 class="mt-4">Daftar Key</h3>
   <table class="table table-striped">
    <thead>
        <tr>
            <th>Nomor</th>
            <th>Role</th>
            <th>Key</th>
            <th>Created At</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
  @if(isset($keys) && $keys->isNotEmpty())
    @foreach ($keys as $index => $key)
        <tr>
            <td>{{ $index + 1 }}</td>
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
@else
    <tr>
        <td colspan="5">Data tidak tersedia</td>
    </tr>
@endif
    </tbody>
</table>
      `,
      dataKwintasi: '<h2>Backup All Data</h2><p>Konten kwintansi di sini.</p>',
        dataLaporan: '<h2>Data Laporan</h2><p>Konten data laporan di sini.</p>',
        dataBuktiPembayaran: '<h2>Data Bukti Pembayaran</h2><p>Konten data bukti pembayaran di sini.</p>',
        dataPengujian: `
 <h2>Data Pengujian</h2>
<!-- Form to Add or Edit Data Pengujian -->
<form id="pengujianForm" action="{{ route('pengujian.store') }}" method="POST">
    @csrf
    @method('POST') <!-- Default method for creating new data -->
    <div class="mb-3">
        <label for="jenisMaterial" class="form-label">Jenis Material</label>
        <select class="form-select" id="jenisMaterial" name="jenis_material" required>
            <option value="">Pilih Jenis Material</option>
            <option value="Agregat Halus">Agregat Halus & Kasar</option>
            <option value="Pengujian kayu">Pengujian kayu</option>
            <option value="Pengujian baja">Pengujian baja</option>
            <option value="Pengujian dilapangan">Pengujian dilapangan</option>
            <option value="Batako dan Paving block">Batako dan Paving block</option>
            <option value="Semen">Semen</option>
            <option value="Lainya">Lainya</option>
        </select>
    </div>

    <div class="mb-3">
        <label for="jenisPengujian" class="form-label">Jenis Pengujian</label>
        <input type="text" class="form-control" id="jenisPengujian" name="jenis_pengujian" required>
    </div>
    
    <div class="mb-3">
        <label for="hargaSatuan" class="form-label">Harga Satuan</label>
        <input type="number" class="form-control" id="hargaSatuan" name="harga_satuan" required>
    </div>
    
    <button type="submit" class="btn btn-primary">Simpan</button>
</form>

<!-- Table Data Pengujian -->
<h3 class="mt-4">Daftar Pengujian</h3>
<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Jenis Material</th>
            <th>Jenis Pengujian</th>
            <th>Harga Satuan</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @if($pengujianData->isEmpty())
            <tr>
                <td colspan="5">Data tidak tersedia</td>
            </tr>
        @else
            @foreach ($pengujianData as $data)
                <tr>
                    <td>{{ $data->id }}</td>
                    <td>{{ $data->jenis_material }}</td>
                    <td>{{ $data->jenis_pengujian }}</td>
                    <td>{{ $data->harga_satuan }}</td>
                    <td>
                        <!-- Edit Button: Trigger JavaScript to pre-fill the form -->
                     <a href="{{ url('/data-pelanggan/' . $pelanggan->id) }}">Edit</a>


                        <!-- Delete Form: Separate form for deletion -->
                        <form action="{{ route('pengujian.destroy', $data->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
    `,
  };

  document.getElementById('mainContent').innerHTML = content[page];
}

    function generateKey() {
          const keyInput = document.getElementById('generatedKey');
          const saveButton = document.getElementById('saveKeyButton');
          keyInput.value = generateRandomString(6);
          saveButton.style.display = 'inline-block';
    }

    function generateRandomString(length) {
          const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
          let result = '';
          for (let i = 0; i < length; i++) {
            result += characters.charAt(Math.floor(Math.random() * characters.length));
          }
          return result;
    }
    function editPengujian(id, jenisMaterial, jenisPengujian, hargaSatuan) {
        // Populate the form with the data from the selected record
        document.getElementById('jenisMaterial').value = jenisMaterial;
        document.getElementById('jenisPengujian').value = jenisPengujian;
        document.getElementById('hargaSatuan').value = hargaSatuan;

        // Change the form action to point to the correct PUT route for updating the record
        const form = document.getElementById('pengujianForm');
        form.action = '/pengujian/' + id;  // Use the correct route for update
        document.querySelector('button[type="submit"]').innerText = 'Update'; // Optionally change button text to 'Update'

        // Set the method to PUT for update
        document.querySelector('form').setAttribute('method', 'POST');
        const methodInput = document.createElement('input');
        methodInput.setAttribute('name', '_method');
        methodInput.setAttribute('value', 'PUT');
        form.appendChild(methodInput);
    }



    @if (session('success-hapus-key'))
    alert("Berhasil Menghapus Key ");
    showContent('generateKey');
@endif
    @if (session('success-simpan-key'))
    alert("Berhasil Menyimpan Key ");
    showContent('generateKey');
@endif
    @if (session('success-simpan-pengujian'))
    alert("Berhasil Menyimpan Pengujian ");
    showContent('dataPengujian');
@endif
    @if (session('success-hapus-pengujian'))
    alert("Berhasil Menghapus Pengujian ");
    showContent('dataPengujian');
@endif
    @if (session('success-edit-pengujian'))
    alert("Berhasil Mengedit Pengujian ");
    showContent('dataPengujian');
@endif
  </script>
</body>
</html>

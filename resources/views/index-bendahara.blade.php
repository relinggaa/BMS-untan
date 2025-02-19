<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
  <title>Dashboard - Bendahara</title>
  <link rel="stylesheet" href="/dashboard/assets/vendor/fonts/boxicons.css" />
  <link rel="stylesheet" href="/dashboard/assets/vendor/css/core.css" />
  <link rel="stylesheet" href="/dashboard/assets/vendor/css/theme-default.css" />
  <link rel="stylesheet" href="/dashboard/assets/css/demo.css" />
  <script src="/dashboard/assets/vendor/js/helpers.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">


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
</style>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<body>
  <!-- Verifikasi Session -->
  @if (!session('login_bendahara'))
  <script>
    alert("Anda harus login terlebih dahulu.");
    window.location.href = "{{ route('login.bendahara') }}";
  </script>
  @endif

  <!-- Navbar untuk Mobile -->
  <nav class="navbar navbar-expand-lg navbar-light d-lg-none">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item"><a class="nav-link" href="#" onclick="showContent('dataAdministrasi')"><i class="menu-icon bx bx-download"></i>Data Administrasi</a></li>
          <li class="nav-item"><a class="nav-link" href="#" onclick="showContent('invoice')"><i class="menu-icon bx bx-notepad"></i>Buat Invoice</a></li>
          <li class="nav-item"><a class="nav-link" href="#" onclick="showContent('invoice')"><i class="menu-icon bx bx-notepad"></i>Daftar Invoice</a></li>
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
          <li><a href="#" class="menu-link" onclick="showContent('dataAdministrasi')"><i class="menu-icon bx bx-download"></i>Data Administrasi</a></li>
          <li><a href="#" class="menu-link" onclick="showContent('buatInvoice')"><i class="menu-icon bx bx-notepad"></i>Buat Invoice</a></li>
          <li><a href="#" class="menu-link" onclick="showContent('invoice')"><i class="menu-icon bx bx-notepad"></i>DaftarInvoice</a></li>
          <li><a href="#" class="menu-link" onclick="showContent('kas')"><i class="menu-icon bx bx-notepad"></i>Buat KAS</a></li>
          <li><a href="#" class="menu-link" onclick="showContent('kwitansi')"><i class="menu-icon bx bx-file"></i>Buat Kwitansi</a></li>
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
            <!-- Modal -->
      <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageModalLabel">Bukti Pembayaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img id="modalImage" src="" class="img-fluid" alt="Bukti Pembayaran" />
                </div>
            </div>
        </div>
      </div>

      <!-- Main Content -->
      <div class="flex-grow-1 p-3" id="mainContent">
        <h1>Selamat Datang di Halaman Bendahara</h1>
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
function searchInvoice() {
    const noInvoice = document.getElementById('no_invoice').value;


    fetch(`/data-pelanggan-bendahara/${noInvoice}`)
        .then(response => response.json())
        .then(data => {
            if (data) {
           
                document.getElementById('nama_perusahaan').value = data.nama_perusahaan;
                document.getElementById('nama_proyek').value = data.nama_proyek;
                document.getElementById('permohonan').value = data.permohonan;
                document.getElementById('tanggal_datang').value = data.tanggal_datang;

                let teknisiSelect = document.getElementById('teknisi');
                teknisiSelect.innerHTML = ''; 

     
                let teknisiList = data.teknisi.split(',');

                teknisiList.forEach(teknisi => {
                    let option = document.createElement("option");
                    option.value = teknisi.trim();  
                    option.text = teknisi.trim();
                    option.selected = true;  
                    teknisiSelect.appendChild(option);
                });

            } else {
                alert('Nomor Invoice tidak ditemukan');
            }
        })
        .catch(error => console.error('Error fetching invoice:', error));
}
function showImage(imageUrl) {
  
    document.getElementById('modalImage').src = imageUrl;
}


    function showContent(page) {
      const content = {
        dataAdministrasi: `<h2>Data Administrasi</h2>

     

          <ul class="list-group">
            @foreach ($files as $file)
              <li class="list-group-item">
                <a href="{{ asset('storage/' . $file->file_path) }}" target="_blank">
                  {{ basename($file->file_path) }}
                </a>
                <small class="text-muted">
                  - Diupload pada: {{ $file->created_at->format('d M Y H:i') }}
                </small>
              </li>
            @endforeach
          </ul>`,
          buatInvoice: `
        <h2>Buat Invoice</h2>
     <form id="invoiceForm" action="{{ route('invoice.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="no_invoice" class="form-label">Masukan Nomor Invoice</label>
                <input type="text" class="form-control" id="no_invoice" name="no_invoice" required>
                <button type="button" class="btn btn-success mt-2" onclick="searchInvoice()">Search</button>
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
                <select class="form-control" id="teknisi" name="teknisi[]" multiple required>
                </select>
            </div>
               <div class="mb-3">
        <label for="jenis_material" class="form-label">Jenis Material</label>
          <select class="form-control" id="jenis_material" name="jenis_material" required>
            <option value="">Pilih Jenis Material</option>
            @foreach ($pengujianData as $item)
                <option value="{{ $item->jenis_material }}">
                    {{ $item->jenis_material }} 
                </option>
            @endforeach
        </select>

    </div>
   
          <div class="mb-3">
        <label for="jenis_pengujian" class="form-label">Jenis Pengujian</label>
          <select class="form-control" id="jenis_pengujian" name="jenis_pengujian" required>
            <option value="">Pilih Jenis Pengujian</option>
            @foreach ($pengujianData as $item)
                <option value="{{ $item->jenis_pengujian }}" data-harga_satuan="{{ $item->harga_satuan }}">
                    {{ $item->jenis_pengujian }} - Harga Rp. {{ $item->harga_satuan }}
                </option>
            @endforeach
        </select>

    </div>
         
        <div class="mb-3">
            <label for="jumlah" class="form-label">Jumlah</label>
            <input type="number" class="form-control" id="jumlah" name="jumlah" required>
            <button type="button" class="btn btn-info mt-2" id="hitungBtn">Hitung</button>
        </div>

        <div class="mb-3">
            <label for="total_biaya" class="form-label">Total Biaya</label>
            <input type="text" class="form-control" id="total_biaya" name="total_biaya" readonly>
        </div>



            <div class="mb-3">
                <label for="jenis_pembayaran" class="form-label">Jenis Pembayaran</label>
                <input type="text" class="form-control" id="jenis_pembayaran" name="jenis_pembayaran" required>
            </div>

            <div class="mb-3">
                <label for="bukti_pembayaran" class="form-label">Bukti Pembayaran</label>
                <input type="file" class="form-control" id="bukti_pembayaran" name="bukti_pembayaran" required>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>`,
        invoice: `<h2>Invoice</h2>
        
        <table class="table table-striped">
        <thead>
            <tr>
                <th>No Invoice</th>
                <th>Nama Perusahaan</th>
                <th>Nama Proyek</th>
                 <th>Permohonan</th>
                 <th>Tanggal Datang</th>
                 <th>Jenis Material</th>
                  <th>Jenis Pengujian</th>
                  <th>Jenis Pembayaran</th>
                <th>Teknisi</th>
                <th>Total Biaya</th>
                <th>Jumlah</th>
               
                <th>Bukti Pembayaran</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($invoices as $invoice)
                <tr>
                    <td>{{ $invoice->no_invoice }}</td>
                    <td>{{ $invoice->nama_perusahaan }}</td>
                    <td>{{ $invoice->nama_proyek }}</td>
                    <td>{{ $invoice->permohonan }}</td>
                    <td>{{ $invoice->tanggal_datang }}</td>
                    <td>{{ $invoice->jenis_material }}</td>
                    <td>{{ $invoice->jenis_pengujian }}</td>
                    <td>{{ $invoice->jenis_pembayaran }}</td>
                 
                    <td>{{ $invoice->teknisi }}</td>
                    <td>Rp. {{ number_format($invoice->total_biaya, 2) }}</td>
                   <td>{{ $invoice->jumlah }}</td>
                  <td>
                        @if($invoice->bukti_pembayaran)
                            <a href="#" data-bs-toggle="modal" data-bs-target="#imageModal" onclick="showImage('{{ asset('storage/' . $invoice->bukti_pembayaran) }}')">
                                <img src="{{ asset('storage/' . $invoice->bukti_pembayaran) }}" alt="Bukti Pembayaran" width="100" />
                            </a>
                        @else
                            <span>No Image</span>
                        @endif
                  </td>

                </tr>
            @endforeach
        </tbody>
    </table>`,
        kas: `<h2>Buat KAS</h2><p>Halaman untuk membuat KAS.</p>`,
        kwitansi: `<h2>Buat Kwitansi</h2><p>Halaman untuk membuat Kwitansi.</p>`,
      };
      document.getElementById('mainContent').innerHTML = content[page];
    }

    document.addEventListener('click', function(event) {

    if (event.target && event.target.id === 'hitungBtn') {
    

       
        const jenisPengujian = document.getElementById('jenis_pengujian');
        const jumlah = document.getElementById('jumlah');

        if (!jenisPengujian || !jumlah) {

            return;
        }

        const jumlahValue = jumlah.value;

    
        if (jumlahValue === "" || isNaN(jumlahValue) || jumlahValue <= 0) {
            alert("Jumlah harus berupa angka yang valid.");
            return;
        }

        // Ambil elemen option yang dipilih
        const selectedOption = jenisPengujian.options[jenisPengujian.selectedIndex];
      

  
        const hargaSatuan = selectedOption ? selectedOption.getAttribute('data-harga_satuan') : null;
       

       
        if (!hargaSatuan) {
            alert("Pilih jenis pengujian terlebih dahulu.");
            return;
        }


        const totalBiaya = parseFloat(hargaSatuan) * parseInt(jumlahValue);
        console.log("Total Biaya: ", totalBiaya); 
      
        document.getElementById('total_biaya').value = totalBiaya.toFixed(2);
    }
});







    @if (session('success-buat-invoice'))
            Swal.fire({
                title: "Invoice Di Buat!",
                text: "Berhasil menyimpan invoice",
                icon: "success",
                confirmButtonColor: "#28a745",
            }).then(() => {
                showContent('buatInvoice');
            });
        @endif


  </script>

</body>
</html>

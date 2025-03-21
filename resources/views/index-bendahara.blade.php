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
          <li class="nav-item"><a class="nav-link" href="#" onclick="showContent('invoice')"><i class="menu-icon bx bx-notepad"></i>Buat invoiceLab</a></li>
          <li class="nav-item"><a class="nav-link" href="#" onclick="showContent('invoice')"><i class="menu-icon bx bx-notepad"></i>Daftar invoiceLab</a></li>
          <li class="nav-item"><a class="nav-link" href="#" onclick="showContent('kas')"><i class="menu-icon bx bx-notepad"></i>Buat KAS</a></li>
          <li class="nav-item"><a class="nav-link" href="#" onclick="showContent('kwitansi')"><i class="menu-icon bx bx-file"></i>Buat Kwitansi</a></li>
          <li class="nav-item"><a class="nav-link" href="#" onclick="showContent('cetakKwitansi')"><i class="menu-icon bx bx-printer"></i>Cetak Kwitansi</a></li>
          <li class="nav-item"><a class="nav-link" href="#" onclick="showContent('daftarInvoice')"><i class="menu-icon bx bx-notepad"></i>Daftar Invoice</a></li>

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
          <li><a href="#" class="menu-link" onclick="showContent('dataPelanggan')"><i class="menu-icon bx bx-user"></i>Data Pelanggan</a></li>
          <li><a href="#" class="menu-link" onclick="showContent('dataAdministrasi')"><i class="menu-icon bx bx-download"></i>Data Administrasi</a></li>
          <li><a href="#" class="menu-link" onclick="showContent('buatInvoice')"><i class="menu-icon bx bx-notepad"></i>Buat invoice lab</a></li>
          <li><a href="#" class="menu-link" onclick="showContent('invoiceLapangan')"><i class="menu-icon bx bx-notepad"></i>Buat invoice lapangan</a></li>
          <li><a href="#" class="menu-link" onclick="showContent('daftarInvoice')"><i class="menu-icon bx bx-notepad"></i>Daftar Invoice</a></li>
          <li><a href="#" class="menu-link" onclick="showContent('kas')"><i class="menu-icon bx bx-notepad"></i>Buat KAS</a></li>
          <li><a href="#" class="menu-link" onclick="showContent('kwitansi')"><i class="menu-icon bx bx-file"></i>Buat Kwitansi</a></li>
          <li><a href="#" class="menu-link" onclick="showContent('cetakKwitansi')"><i class="menu-icon bx bx-printer"></i>Cetak Kwitansi</a></li>
         
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
<!-- Modal Edit Kas -->
<div class="modal fade" id="editKasModal" tabindex="-1" aria-labelledby="editKasModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editKasModalLabel">Edit Kas</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="editKasForm" method="POST" action="">
          @csrf
          @method('PUT')
          
          <!-- Kas ID hidden field -->
          <input type="hidden" id="kasId" name="kasId">

          <div class="mb-3">
            <label for="no_bukti" class="form-label">No Bukti</label>
            <input type="text" class="form-control" id="no_bukti_edit" name="no_bukti" required>
          </div>

          <div class="mb-3">
            <label for="tanggal" class="form-label">Tanggal</label>
            <input type="date" class="form-control" id="tanggal_edit" name="tanggal" required>
          </div>

          <div class="mb-3">
            <label for="nama_kegiatan" class="form-label">Nama Kegiatan</label>
            <input type="text" class="form-control" id="nama_kegiatan_edit" name="nama_kegiatan" required>
          </div>

          <div class="mb-3">
            <label for="nama_perusahaan" class="form-label">Nama Perusahaan</label>
            <input type="text" class="form-control" id="nama_perusahaan_edit" name="nama_perusahaan" required>
          </div>

          <div class="mb-3">
            <label for="debet" class="form-label">Debet</label>
            <input type="number" class="form-control" id="debet_edit" name="debet" required>
          </div>

          <div class="mb-3">
            <label for="keterangan" class="form-label">Keterangan</label>
            <input type="text" class="form-control" id="keterangan_edit" name="keterangan">
          </div>

          <button type="submit" class="btn btn-primary">Update</button>
        </form>
      </div>
    </div>
  </div>
</div>
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


<!-- Modal Edit Kwitansi -->
<div class="modal fade" id="editKwitansiModal" tabindex="-1" aria-labelledby="editKwitansiModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editKwitansiModalLabel">Edit Kwitansi</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="editKwitansiForm" action="{{ route('kwitansi.update', 'placeholder') }}" method="POST">
          @csrf
          @method('PUT')

          <input type="hidden" id="kwitansiId" name="kwitansiId">

          <div class="mb-3">
            <label for="nomor_invoice_kwitansi_edit" class="form-label">Nomor invoiceLab</label>
            <input type="text" class="form-control" id="nomor_invoice_kwitansi_edit" name="nomor_invoice_kwitansi" required>
          </div>

          <div class="mb-3">
            <label for="supplier_kwitansi_edit" class="form-label">Supplier</label>
            <input type="text" class="form-control" id="supplier_kwitansi_edit" name="supplier_kwitansi" required>
          </div>

          <div class="mb-3">
            <label for="proyek_kwitansi_edit" class="form-label">Proyek</label>
            <input type="text" class="form-control" id="proyek_kwitansi_edit" name="proyek_kwitansi" required>
          </div>

          <div class="mb-3">
            <label for="total_tagihan_kwitansi_edit" class="form-label">Total Tagihan</label>
            <input type="number" class="form-control" id="total_tagihan_kwitansi_edit" name="total_tagihan_kwitansi" required>
          </div>

          <div class="mb-3">
            <label for="jenis_pembayaran_kwitansi_edit" class="form-label">Jenis Pembayaran</label>
            <input type="text" class="form-control" id="jenis_pembayaran_kwitansi_edit" name="jenis_pembayaran_kwitansi" required>
          </div>

          <div class="mb-3">
            <label for="untuk_pembayaran_kwitansi_edit" class="form-label">Untuk Pembayaran</label>
            <textarea class="form-control" id="untuk_pembayaran_kwitansi_edit" name="untuk_pembayaran_kwitansi" required></textarea>
          </div>
          <div class="mb-3">
            <label for="telah_diterima_edit" class="form-label">Telah Diterima</label>
            <input type="text" class="form-control" id="telah_diterima_edit" name="telah_diterima_edit" required></input>
          </div>
          <button type="submit" class="btn btn-primary">Update Kwitansi</button>
        </form>
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
                alert('Nomor invoiceLab tidak ditemukan');
            }
        })
        .catch(error => console.error('Error fetching invoiceLab:', error));
}
function showImage(imageUrl) {
  
    document.getElementById('modalImage').src = imageUrl;
}
function editKas(kasId) {
    fetch(`/kas/${kasId}`)
        .then(response => response.json())
        .then(data => {
            // Populate modal form fields with Kas data
            document.getElementById('kasId').value = data.id;
            document.getElementById('no_bukti_edit').value = data.no_bukti;
            document.getElementById('tanggal_edit').value = data.tanggal;
            document.getElementById('nama_kegiatan_edit').value = data.nama_kegiatan;
            document.getElementById('nama_perusahaan_edit').value = data.nama_perusahaan;
            document.getElementById('debet_edit').value = data.debet;
            document.getElementById('keterangan_edit').value = data.keterangan;

            // Set the form action URL for the PUT request (dynamic route)
            document.getElementById('editKasForm').action = `/kas/${kasId}`;
        })
        .catch(error => console.error('Error fetching Kas data:', error));
}

function editKwitansi(id) {
  fetch(`/kwitansi/${id}`)
    .then(response => response.json())
    .then(data => {
        console.log(data); 
        document.getElementById('kwitansiId').value = data.id;
        document.getElementById('nomor_invoice_kwitansi_edit').value = data.nomor_invoice;
        document.getElementById('supplier_kwitansi_edit').value = data.supplier;
        document.getElementById('proyek_kwitansi_edit').value = data.proyek;
        document.getElementById('total_tagihan_kwitansi_edit').value = data.total_tagihan;
        document.getElementById('jenis_pembayaran_kwitansi_edit').value = data.jenis_pembayaran;
        document.getElementById('untuk_pembayaran_kwitansi_edit').value = data.untuk_pembayaran;
        document.getElementById('telah_diterima_edit').value = data.telah_diterima;

        
        document.getElementById('editKwitansiForm').action = `/kwitansi/${data.id}`;
    })
    .catch(error => {
        console.error('Error fetching Kwitansi data:', error);
    });

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
       <h2>Invoice Lab</h2>

  <form id="invoiceForm" action="{{ route('invoice.sto') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <!-- Upload Excel Fields -->
    <div class="mb-3">
        <label for="excel_lab" class="form-label">Upload Excel Lab</label>
        <input type="file" class="form-control" id="excel_lab" name="excel_lab" accept=".xls,.xlsx">
    </div>
    
    <div class="mb-3">
        <label for="excel_lab_dengan_harga" class="form-label">Upload Excel Lab Dengan Harga</label>
        <input type="file" class="form-control" id="excel_lab_dengan_harga" name="excel_lab_dengan_harga" accept=".xls,.xlsx">
    </div>

   

    <!-- Teknisi Selection -->
    <div class="mb-3 mt-4">
        <label for="teknisi" class="form-label">Pilih Teknisi</label>
        <select class="form-control" id="teknisi" name="teknisi[]" multiple required>
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
     <!-- Submit Button -->
    <button type="submit" class="btn btn-primary mt-3">Submit</button>
</form>
<h3>Uploaded Files and Teknisi</h3>
<table class="table">
    <thead>
        <tr>
            <th>No</th>
            <th>Excel Lab</th>
            <th>Excel Lab Dengan Harga</th>
            <th>Teknisi</th>
            <th>Created At</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($invoices as $index => $invoice)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>
                    <a href="{{ asset('storage/' . $invoice->excel_lab) }}" target="_blank">
                        {{ basename($invoice->excel_lab) }}
                    </a>
                </td>
                <td>
                    <a href="{{ asset('storage/' . $invoice->excel_lab_dengan_harga) }}" target="_blank">
                        {{ basename($invoice->excel_lab_dengan_harga) }}
                    </a>
                </td>
                <td>{{ $invoice->teknisi }}</td>
                <td>{{ $invoice->created_at->format('d M Y H:i') }}</td>
                  <td>
                    <a href="{{ route('invoice-lab.edit', $invoice->id) }}" class="btn btn-warning">Edit</a>
                </td>
                <td>
    <!-- Delete button -->
              <form action="{{ route('invoice-lab.destroy', $invoice->id) }}" method="POST" style="display:inline;">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus invoice ini?')">Hapus</button>
              </form>
          </td>

            </tr>
        @endforeach
    </tbody>
</table>
`,
daftarInvoice: `
  <h2>Daftar Invoice</h2>

  <!-- Form untuk menambah data invoice -->
   <form action="{{ route('invoice.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-md-12">
            <div class="mb-3">
                <label for="no_invoice" class="form-label">No Invoice</label>
                <input type="text" class="form-control" id="no_invoice" name="no_invoice" required>
                  <button type="button" class="btn btn-success mt-2" onclick="searchInvoice()">Search</button>
            </div>
        </div>
        
        <div class="col-md-12">
            <div class="mb-3">
                <label for="nama_perusahaan" class="form-label">Nama Perusahaan</label>
                <input type="text" class="form-control" id="nama_perusahaan" name="nama_perusahaan" required>
            </div>
        </div>
        
        <div class="col-md-12">
            <div class="mb-3">
                <label for="nama_proyek" class="form-label">Nama Proyek</label>
                <input type="text" class="form-control" id="nama_proyek" name="nama_proyek" required>
            </div>
        </div>

        <div class="col-md-12">
            <div class="mb-3">
                <label for="permohonan" class="form-label">Permohonan</label>
                <input type="text" class="form-control" id="permohonan" name="permohonan" required>
            </div>
        </div>

        <div class="col-md-12">
            <div class="mb-3">
                <label for="tanggal_datang" class="form-label">Tanggal Datang</label>
                <input type="date" class="form-control" id="tanggal_datang" name="tanggal_datang" required>
            </div>
        </div>

        <div class="col-md-12">
            <div class="mb-3">
                <label for="tanggal_pembayaran_ke_va" class="form-label">Tanggal Pembayaran Ke VA</label>
                <input type="date" class="form-control" id="tanggal_pembayaran_ke_va" name="tanggal_pembayaran_ke_va" required>
            </div>
        </div>

        <div class="col-md-12">
            <div class="mb-3">
                <label for="total_harga" class="form-label">Total Harga</label>
                <input type="number" class="form-control" id="total_harga" name="total_harga" required>
            </div>
        </div>

        <div class="col-md-12">
            <div class="mb-3">
                <label for="jenis_pembayaran" class="form-label">Jenis Pembayaran</label>
                <input type="text" class="form-control" id="jenis_pembayaran" name="jenis_pembayaran" required>
            </div>
        </div>

        <div class="col-md-12">
            <div class="mb-3">
                <label for="bukti_pembayaran" class="form-label">Bukti Pembayaran</label>
                <input type="file" class="form-control" id="bukti_pembayaran" name="bukti_pembayaran" required>
            </div>
        </div>
        
        <div class="col-md-12">
            <button type="submit" class="btn btn-success">Tambah Invoice</button>
        </div>
    </div>
</form>


  <br><br>
  <h3>Daftar Invoice yang Tersimpan</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No Invoice</th>
                <th>Nama Perusahaan</th>
                <th>Nama Proyek</th>
                <th>Permohonan</th>
                <th>Tanggal Datang</th>
                <th>Tanggal Pembayaran Ke VA</th>
                <th>Total Harga</th>
                <th>Jenis Pembayaran</th>
                <th>Bukti Pembayaran</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($Dfinvoices as $invoice)
                <tr>
                    <td>{{ $invoice->no_invoice }}</td>
                    <td>{{ $invoice->nama_perusahaan }}</td>
                    <td>{{ $invoice->nama_proyek }}</td>
                    <td>{{ $invoice->permohonan }}</td>
                    <td>{{ \Carbon\Carbon::parse($invoice->tanggal_datang)->format('d-m-Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($invoice->tanggal_pembayaran_ke_va)->format('d-m-Y') }}</td>
                    <td>Rp {{ number_format($invoice->total_harga, 2, ',', '.') }}</td>
                   <td>{{ $invoice->jenis_pembayaran }}</td>
             <td>
                    @if($invoice->bukti_pembayaran)
                        <!-- Thumbnail Image -->
                 
                    <img src="{{ asset('storage/' . $invoice->bukti_pembayaran) }}" alt="Bukti Pembayaran" class="img-thumbnail" style="width: 100px; height: auto; cursor: pointer;" onclick="showImage('{{ asset('storage/' . $invoice->bukti_pembayaran) }}')">


                    @else
                        Tidak ada bukti
                    @endif
                </td>

                   
                </tr>
            @endforeach
        </tbody>
    </table>
  <!-- Tabel Daftar Invoice -->
  
`
,
        dataPelanggan: `<h2>Data Pelanggan</h2>
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>No invoiceLab</th>
                          <th>Nama Perusahaan</th>
                          <th>Nama Proyek</th>
                          <th>Permohonan</th>
                          <th>Tanggal Datang</th>
                 
                          <th>Keterangan</th>
                          <th>Pembayaran</th>
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
                          
                            <td>{{ $pelanggan->keterangan }}</td>
                            <td>{{ $pelanggan->pembayaran }}</td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>`,
      
        kas: `<h2>KAS</h2>
<form action="{{ route('kas.submit') }}" method="POST">
         @csrf
  <div class="container mt-3">
 
    <div class="form-group mb-3">
      <label for="no_bukti">No Bukti</label>
      <input type="text" name="no_bukti" id="no_bukti" class="form-control" required>
    </div>
    <div class="form-group mb-3">
      <label for="tanggal">Tanggal</label>
      <input type="date" name="tanggal" id="tanggal" class="form-control" required>
    </div>
    <div class="form-group mb-3">
      <label for="nama_kegiatan">Nama Kegiatan</label>
      <input type="text" name="nama_kegiatan" id="nama_kegiatan" class="form-control" required>
    </div>
    <div class="form-group mb-3">
      <label for="nama_perusahaan">Nama Perusahaan</label>
      <input type="text" name="nama_perusahaan" id="nama_perusahaan" class="form-control" required>
    </div>
    <div class="form-group mb-3">
      <label for="debet">Debet</label>
      <input type="number" name="debet" id="debet" class="form-control" required>
    </div>
    <div class="form-group mb-3">
      <label for="keterangan">Keterangan</label>
      <input type="text" name="keterangan" id="keterangan" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </div>
</form>
<form action="{{ route('kas.filter') }}" method="GET" class="mb-4">
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
<div class="d-flex">
  <!-- Export to Excel Button -->
  <form action="{{ url('kas/export') }}" method="GET">
    <input type="hidden" name="start_date" value="{{ request('start_date') }}">
    <input type="hidden" name="end_date" value="{{ request('end_date') }}">
    <button type="submit" class="btn btn-success {{ !request('start_date') || !request('end_date') ? 'disabled' : '' }}">
      Export to Excel
    </button>
  </form>
  <button onclick="printTable()" class="btn btn-primary ms-2">Print</button>
</div>
     <table class="table table-bordered mt-4">
            <thead>
                <tr>
      
                    <th>No Bukti</th>
                    <th>Tanggal</th>
                    <th>Nama Kegiatan</th>
                    <th>Nama Perusahaan</th>
                    <th>Debet</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kasData as $kas)
                    <tr>
                     
                        <td>{{ $kas->no_bukti }}</td>
                        <td>{{ \Carbon\Carbon::parse($kas->tanggal)->format('d/m/Y') }}</td>
                        <td>{{ $kas->nama_kegiatan }}</td>
                        <td>{{ $kas->nama_perusahaan }}</td>
                        <td>Rp. {{ number_format($kas->debet, 2) }}</td>
                        <td>{{ $kas->keterangan }}</td>
                      <td>
                          <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editKasModal" onclick="editKas({{ $kas->id }})">
                            Edit
                          </button>
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
`,  
    invoiceLapangan: `
      <h2>Invoice Lapangan</h2>
      <form id="invoiceLapanganForm" action="{{ route('invoice-lapangan.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
          <label for="excel_lab" class="form-label">Upload Excel Lab</label>
          <input type="file" class="form-control" id="excel_lab" name="excel_lab" accept=".xls,.xlsx">
        </div>
        <div class="mb-3">
          <label for="excel_lab_dengan_harga" class="form-label">Upload Excel Lab Dengan Harga</label>
          <input type="file" class="form-control" id="excel_lab_dengan_harga" name="excel_lab_dengan_harga" accept=".xls,.xlsx">
        </div>
        <div class="mb-3 mt-4">
          <label for="teknisi" class="form-label">Pilih Teknisi</label>
          <select class="form-control" id="teknisi" name="teknisi[]" multiple required>
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
        <button type="submit" class="btn btn-primary mt-3">Submit</button>
      </form>
      <h3>Daftar Invoice Lapangan</h3>
<table class="table">
    <thead>
        <tr>
            <th>No</th>
            <th>Excel Lab</th>
            <th>Excel Lab Dengan Harga</th>
            <th>Teknisi</th>
            <th>Created At</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($invoicesLapangan as $index => $invoice)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td><a href="{{ asset('storage/' . $invoice->excel_lab) }}" target="_blank">{{ basename($invoice->excel_lab) }}</a></td>
            <td><a href="{{ asset('storage/' . $invoice->excel_lab_dengan_harga) }}" target="_blank">{{ basename($invoice->excel_lab_dengan_harga) }}</a></td>
            <td>{{ $invoice->teknisi }}</td>
            <td>{{ $invoice->created_at->format('d M Y H:i') }}</td>
            <td>
                <a href="{{ route('invoice-lapangan.edit', $invoice->id) }}" class="btn btn-warning">Edit</a>
                <form action="{{ route('invoice-lapangan.destroy', $invoice->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus invoice ini?')">Hapus</button>
                  
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
      `
      ,
      kwitansi: `<h2>Buat Kwitansi</h2>
<p>Halaman untuk membuat Kwitansi.</p>
<form id="kwitansiForm" action="{{ route('kwitansi.store') }}" method="POST">
  @csrf
  <div class="mb-3">
    <label for="nomor_invoice_kwitansi" class="form-label">Nomor Invoice</label>
    <input type="text" class="form-control" id="nomor_invoice_kwitansi" name="nomor_invoice_kwitansi" required>
    <button type="button" class="btn btn-success mt-2" onclick="searchKwitansi()">Search</button>
  </div>

  <div class="mb-3">
    <label for="supplier_kwitansi" class="form-label">Supplier</label>
    <input type="text" class="form-control" id="supplier_kwitansi" name="supplier_kwitansi" required>
  </div>

  <div class="mb-3">
    <label for="proyek_kwitansi" class="form-label">Proyek</label>
    <input type="text" class="form-control" id="proyek_kwitansi" name="proyek_kwitansi" required>
  </div>

  <div class="mb-3">
    <label for="total_tagihan_kwitansi" class="form-label">Total Tagihan</label>
    <input type="number" class="form-control" id="total_tagihan_kwitansi" name="total_tagihan_kwitansi" required>
  </div>

  <div class="mb-3">
    <label for="jenis_pembayaran_kwitansi" class="form-label">Jenis Pembayaran</label>
    <input type="text" class="form-control" id="jenis_pembayaran_kwitansi" name="jenis_pembayaran_kwitansi" required>
  </div>

  <div class="mb-3">
    <label for="untuk_pembayaran_kwitansi" class="form-label">Untuk Pembayaran</label>
    <textarea class="form-control" id="untuk_pembayaran_kwitansi" name="untuk_pembayaran_kwitansi" required></textarea>
  </div>
  <div class="mb-3">
    <label for="telah_diterima" class="form-label">Telah Diterima</label>
    <input type="text" class="form-control" id="telah_diterima" name="telah_diterima" required></input>
  </div>

  <button type="submit" class="btn btn-primary">Simpan Kwitansi</button>
</form>

<hr>

<h1>Daftar Kwitansi</h1>

<table class="table table-bordered table-striped table-hover">
    <thead class="table-light">
        <tr>
            <th>Nomor Invoice</th>
            <th>Supplier</th>
            <th>Proyek</th>
            <th>Total Tagihan</th>
            <th>Jenis Pembayaran</th>
            <th>Untuk Pembayaran</th>
            <th>Telah Di Terima</th>
            <th>Tanggal</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($kwitansis as $kwitansi)
            <tr>
                <td>{{ $kwitansi->nomor_invoice }}</td>
                <td>{{ $kwitansi->supplier }}</td>
                <td>{{ $kwitansi->proyek }}</td>
                <td>Rp. {{ number_format($kwitansi->total_tagihan, 2) }}</td>
                <td>{{ $kwitansi->jenis_pembayaran }}</td>
                <td>{{ $kwitansi->untuk_pembayaran }}</td>
                <td>{{ $kwitansi->telah_diterima }}</td>
                <td>{{ $kwitansi->created_at->format('d-m-Y') }}</td>
                 <td>
                  
                </td>
                 <td>
                    @if($kwitansi->is_sent)
                         <a href="{{ route('kwitansi.edit', $kwitansi->id) }}" class="disabled btn btn-warning">Edit</a>
                      <form action="{{ route('kwitansi.destroy', $kwitansi->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kwitansi ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger disabled">Hapus</button>
                    </form>
                    @else
                     <form action="{{ route('kwitansi.send', $kwitansi->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-primary" @if($kwitansi->is_sent) disabled @endif>Kirim</button>
                        </form>
                       <a href="{{ route('kwitansi.edit', $kwitansi->id) }}" class="btn btn-warning">Edit</a>
                      <form action="{{ route('kwitansi.destroy', $kwitansi->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kwitansi ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                    @endif
                </td>
                  
            </tr>
        @endforeach
    </tbody>
</table>


`
,

    cetakKwitansi: `
      <h2>Cetak Kwitansi</h2>
      <table class="table table-bordered table-striped table-hover">
        <thead class="table-light">
          <tr>
            <th>Nomor Invoice</th>
            <th>Supplier</th>
            <th>Proyek</th>
            <th>Total Tagihan</th>
            <th>Jenis Pembayaran</th>
            <th>Untuk Pembayaran</th>
            <th>Tanggal</th>
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
            <td>{{ $kwitansi->created_at->format('d-m-Y') }}</td>
         <td>
            <a href="{{ route('kwitansi.detail', $kwitansi->id) }}" class="btn btn-primary">Cetak</a>
          </td>
          </tr>
          @endforeach
        </tbody>
      </table>
     
    `,




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

document.addEventListener("DOMContentLoaded", function() {
   
    const url = window.location.href;


    if (url.includes('invoice/filter') && url.includes('start_date') && url.includes('end_date')) {
 
        showContent('invoice');
    }
});
document.addEventListener("DOMContentLoaded", function() {
   
    const url = window.location.href;


    if (url.includes('kas/filter') && url.includes('start_date') && url.includes('end_date')) {
 
        showContent('kas');
    }
});
function printTable() {
    var table = document.querySelector(".table"); 


    var tableClone = table.cloneNode(true);
    tableClone.querySelectorAll("td.actions, th.actions, td button").forEach(element => element.remove());


    var newWindow = window.open("", "", "width=900,height=600");
    newWindow.document.write(`
        <html>
        <head>
            <title>Print Data Pelanggan</title>
            <style>
                body { font-family: Arial, sans-serif; padding: 20px; }
                table { width: 100%; border-collapse: collapse; margin-top: 20px; }
                th, td { border: 1px solid black; padding: 8px; text-align: left; }
                th { background-color: #f2f2f2; }
            </style>
        </head>
        <body>
            <h2>Data Pelanggan</h2>
            ${tableClone.outerHTML} 
            <script>
                window.onload = function() {
                    window.print();
                    window.onafterprint = function() { window.close(); };
                };
            <\/script>
        </body>
        </html>
    `);
    newWindow.document.close();
}


function editInvoiceLab(invoiceLabId) {
    fetch(`/invoice-lab/${invoiceLabId}`)
        .then(response => response.json())
        .then(data => {
      
            document.getElementById('invoiceLabId').value = data.id;
            document.getElementById('excel_lab_edit').value = data.excel_lab;  // You might need to display the file name or something else
            document.getElementById('excel_lab_dengan_harga_edit').value = data.excel_lab_dengan_harga;  // Same as above
            
     
            let teknisiSelect = document.getElementById('teknisi_edit');
            teknisiSelect.innerHTML = '';  

            let teknisiList = data.teknisi.split(',');

            teknisiList.forEach(teknisi => {
                let option = document.createElement("option");
                option.value = teknisi.trim();  
                option.text = teknisi.trim();
                option.selected = true;  
                teknisiSelect.appendChild(option);
            });

      
            document.getElementById('editInvoiceLabForm').action = `/invoice-lab/${invoiceLabId}`;
        })
        .catch(error => console.error('Error fetching Invoice Lab data:', error));
}
function searchInvoice() {
    const noInvoice = document.getElementById('no_invoice').value;

   
    fetch(`/data-pelanggan/${noInvoice}`)
        .then(response => response.json())
        .then(data => {
            if (data) {
        
                document.getElementById('nama_perusahaan').value = data.nama_perusahaan;
                document.getElementById('nama_proyek').value = data.nama_proyek;
                document.getElementById('permohonan').value = data.permohonan;
                document.getElementById('tanggal_datang').value = data.tanggal_datang;
               
            } else {
                alert('No invoice found with that number!');
            }
        })
        .catch(error => console.error('Error fetching invoice data:', error));
}

function searchKwitansi() {
        const nomorInvoice = document.getElementById('nomor_invoice_kwitansi').value;

        fetch(`/data-kwitansi/${nomorInvoice}`)
            .then(response => response.json())
            .then(data => {
                if (data) {
                    document.getElementById('supplier_kwitansi').value = data.nama_perusahaan;
                    document.getElementById('proyek_kwitansi').value = data.nama_proyek;
                    document.getElementById('total_tagihan_kwitansi').value = data.total_biaya;
                    document.getElementById('jenis_pembayaran_kwitansi').value = data.jenis_pembayaran;
                    document.getElementById('untuk_pembayaran_kwitansi').value = data.untuk_pembayaran;
                } else {
                    alert('Nomor Invoice tidak ditemukan');
                }
            })
            .catch(error => console.error('Error fetching kwitansi:', error));
    }
    function showImage(imageUrl) {

    document.getElementById('modalImage').src = imageUrl;
    
    $('#imageModal').modal('show');
}

    @if (session('success-buat-invoice'))
            Swal.fire({
                title: "Invoice Di Buat!",
                text: "Berhasil menyimpan invoiceLab",
                icon: "success",
                confirmButtonColor: "#28a745",
            }).then(() => {
                showContent('buatInvoice');
            });
        @endif
    @if (session('success-simpan-kas'))
            Swal.fire({
                title: "Invoice Di Buat!",
                text: "Berhasil menyimpan kas",
                icon: "success",
                confirmButtonColor: "#28a745",
            }).then(() => {
                showContent('kas');
            });
        @endif
        @if (session('filter-tanggal-invoice'))
            Swal.fire({
                title: "Filter Tanggal",
                text: "Menampilkan data berdasarkan rentang tanggal yang dipilih",
                icon: "info",
                confirmButtonColor: "#007bff",
            }).then(() => {
                showContent('invoice');
            });
        @endif         
        @if (session('success-edit-kas'))
            Swal.fire({
                title: "Edit Berhasil",
                text: "Data kas telah diperbarui",
                icon: "success",
                confirmButtonColor: "#28a745",
            }).then(() => {
                showContent('kas');
            });
            @endif
        @if (session('success-edit-kwitansi'))
            Swal.fire({
                title: "Edit Berhasil",
                text: "Data kwitasi telah diperbarui",
                icon: "success",
                confirmButtonColor: "#28a745",
            }).then(() => {
                showContent('kwitansi');
            });
            @endif
        @if (session('success-edit-invoicelab'))
            Swal.fire({
                title: "Edit Berhasil",
                text: "Data invoice lab telah diperbarui",
                icon: "success",
                confirmButtonColor: "#28a745",
            }).then(() => {
                showContent('buatInvoice');
            });
            @endif
        @if (session('success-edit-kwitansi'))
            Swal.fire({
                title: "Edit Berhasil",
                text: "Data kwintansi telah diperbarui",
                icon: "success",
                confirmButtonColor: "#28a745",
            }).then(() => {
                showContent('kwitansi');
            });
        @endif
        @if (session('success-edit-lapangan'))
            Swal.fire({
                title: "Edit Berhasil",
                text: "Data invoice lapangan telah diperbarui",
                icon: "success",
                confirmButtonColor: "#28a745",
            }).then(() => {
                showContent('invoiceLapangan');
            });
        @endif
        @if (session('success-simpan-kwitansi'))
            Swal.fire({
                title: "Berhasil",
                text: "Data kwintansi telah di simpan",
                icon: "success",
                confirmButtonColor: "#28a745",
            }).then(() => {
                showContent('kwitansi');
            });
        @endif
        @if (session('success-buat-invoice-lapangan'))
            Swal.fire({
                title: "Berhasil",
                text: "Data invoice lapangan telah di simpan",
                icon: "success",
                confirmButtonColor: "#28a745",
            }).then(() => {
                showContent('invoiceLapangan');
            });
        @endif
        @if (session('success-simpan-daftar-invoices'))
            Swal.fire({
                title: "Berhasil",
                text: "Daftar invoice telah di simpan",
                icon: "success",
                confirmButtonColor: "#28a745",
            }).then(() => {
                showContent('daftarInvoice');
            });
        @endif
        @if (session('success-kirim-kepalalab'))
            Swal.fire({
                title: "Berhasil",
                text: "Data kwintansi telah di kirim ke kepala lab",
                icon: "success",
                confirmButtonColor: "#28a745",
            }).then(() => {
                showContent('kwitansi');
            });
        @endif
        @if (session('success-hapus-kwintansi'))
            Swal.fire({
                title: " Berhasil",
                text: "Data kwintansi telah di hapus",
                icon: "warning",
                confirmButtonColor: "#dc3545",
            }).then(() => {
                showContent('kwitansi');
            });
        @endif
        @if (session('success-hapus-invoicelab'))
            Swal.fire({
                title: " Berhasil",
                text: "Data invoice lab telah di hapus",
                icon: "warning",
                confirmButtonColor: "#dc3545",
            }).then(() => {
                showContent('buatInvoice');
            });
        @endif
        @if (session('success-hapus-invoice-lapangan'))
            Swal.fire({
                title: " Berhasil",
                text: "Data invoice lapangan telah di hapus",
                icon: "warning",
                confirmButtonColor: "#dc3545",
            }).then(() => {
                showContent('invoiceLapangan');
            });
        @endif
      

  </script>

</body>
</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kwitansi</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2>Edit Kwitansi</h2>
        
      
        <form action="{{ route('kwitansi.update', $kwitansi->id) }}" method="POST">
            @csrf
            @method('PUT')


            <div class="mb-3">
                <label for="nomor_invoice_kwitansi" class="form-label">Nomor Invoice</label>
                <input type="text" class="form-control" id="nomor_invoice_kwitansi" name="nomor_invoice_kwitansi" value="{{ $kwitansi->nomor_invoice }}" required>
            </div>

    
            <div class="mb-3">
                <label for="supplier_kwitansi" class="form-label">Supplier</label>
                <input type="text" class="form-control" id="supplier_kwitansi" name="supplier_kwitansi" value="{{ $kwitansi->supplier }}" required>
            </div>

         
            <div class="mb-3">
                <label for="proyek_kwitansi" class="form-label">Proyek</label>
                <input type="text" class="form-control" id="proyek_kwitansi" name="proyek_kwitansi" value="{{ $kwitansi->proyek }}" required>
            </div>


            <div class="mb-3">
                <label for="total_tagihan_kwitansi" class="form-label">Total Tagihan</label>
                <input type="number" class="form-control" id="total_tagihan_kwitansi" name="total_tagihan_kwitansi" value="{{ $kwitansi->total_tagihan }}" required>
            </div>

            <div class="mb-3">
                <label for="jenis_pembayaran_kwitansi" class="form-label">Jenis Pembayaran</label>
                <input type="text" class="form-control" id="jenis_pembayaran_kwitansi" name="jenis_pembayaran_kwitansi" value="{{ $kwitansi->jenis_pembayaran }}" required>
            </div>

      
            <div class="mb-3">
                <label for="untuk_pembayaran_kwitansi" class="form-label">Untuk Pembayaran</label>
                <textarea class="form-control" id="untuk_pembayaran_kwitansi" name="untuk_pembayaran_kwitansi" required>{{ $kwitansi->untuk_pembayaran }}</textarea>
            </div>

  
            <div class="mb-3">
                <label for="telah_diterima" class="form-label">Telah Diterima</label>
                <input type="text" class="form-control" id="telah_diterima" name="telah_diterima" value="{{ $kwitansi->telah_diterima }}" required>
            </div>


            <button type="submit" class="btn btn-primary">Update Kwitansi</button>
        </form>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

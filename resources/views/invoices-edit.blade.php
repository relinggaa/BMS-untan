<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
  <title>Edit Invoice Lab - Bendahara</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
  <!-- Verifikasi Session -->
  @if (!session('login_bendahara'))
  <script>
    alert("Anda harus login terlebih dahulu.");
    window.location.href = "{{ route('login.bendahara') }}";
  </script>
  @endif

  <!-- Navbar -->


  <div class="container mt-5">
    <h1>Edit Invoice Lab</h1>
    <form method="POST" action="{{ route('invoice-lab.update', $invoiceLab->id) }}" enctype="multipart/form-data">
      @csrf

      
      <!-- Hidden input for invoiceLabId -->
      <input type="hidden" name="invoiceLabId" value="{{ $invoiceLab->id }}">

      <!-- Excel Lab File Upload -->
      <div class="mb-3">
        <label for="excel_lab" class="form-label">Upload Excel Lab</label>
        <input type="file" class="form-control" name="excel_lab" accept=".xls,.xlsx">
      </div>

      <!-- Excel Lab with Prices File Upload -->
      <div class="mb-3">
        <label for="excel_lab_dengan_harga" class="form-label">Upload Excel Lab Dengan Harga</label>
        <input type="file" class="form-control" name="excel_lab_dengan_harga" accept=".xls,.xlsx">
      </div>

      <!-- Teknisi Selection -->
      <div class="mb-3">
        <label for="teknisi" class="form-label">Pilih Teknisi</label>
        <select class="form-control" name="teknisi[]" multiple required>
          <option value="TEKNISI A" {{ in_array('TEKNISI A', explode(',', $invoiceLab->teknisi)) ? 'selected' : '' }}>TEKNISI A</option>
          <option value="TEKNISI B" {{ in_array('TEKNISI B', explode(',', $invoiceLab->teknisi)) ? 'selected' : '' }}>TEKNISI B</option>
          <option value="TEKNISI C" {{ in_array('TEKNISI C', explode(',', $invoiceLab->teknisi)) ? 'selected' : '' }}>TEKNISI C</option>
          <option value="TEKNISI D" {{ in_array('TEKNISI D', explode(',', $invoiceLab->teknisi)) ? 'selected' : '' }}>TEKNISI D</option>
          <option value="TEKNISI E" {{ in_array('TEKNISI E', explode(',', $invoiceLab->teknisi)) ? 'selected' : '' }}>TEKNISI E</option>
          <option value="TEKNISI F" {{ in_array('TEKNISI F', explode(',', $invoiceLab->teknisi)) ? 'selected' : '' }}>TEKNISI F</option>
          <option value="TEKNISI G" {{ in_array('TEKNISI G', explode(',', $invoiceLab->teknisi)) ? 'selected' : '' }}>TEKNISI G</option>
          <option value="TEKNISI H" {{ in_array('TEKNISI H', explode(',', $invoiceLab->teknisi)) ? 'selected' : '' }}>TEKNISI H</option>
        </select>
      </div>

      <!-- Submit Button -->
      <button type="submit" class="btn btn-warning mt-3">Update Invoice</button>
    </form>
  </div>




  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

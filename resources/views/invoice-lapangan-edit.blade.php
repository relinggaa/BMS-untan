<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Edit Invoice Lapangan</title>
    <link rel="stylesheet" href="/dashboard/assets/vendor/fonts/boxicons.css" />
    <link rel="stylesheet" href="/dashboard/assets/vendor/css/core.css" />
    <link rel="stylesheet" href="/dashboard/assets/vendor/css/theme-default.css" />
    <link rel="stylesheet" href="/dashboard/assets/css/demo.css" />
    <script src="/dashboard/assets/vendor/js/helpers.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>
<body>

    <div class="container mt-5">
        <h2>Edit Invoice Lapangan</h2>
        <form action="{{ route('invoice-lapangan.update', $invoiceLapangan->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="excel_lab" class="form-label">Upload Excel Lab</label>
                <input type="file" class="form-control" id="excel_lab" name="excel_lab" accept=".xls,.xlsx">
                <small>Current file: {{ basename($invoiceLapangan->excel_lab) }}</small>
            </div>

            <div class="mb-3">
                <label for="excel_lab_dengan_harga" class="form-label">Upload Excel Lab Dengan Harga</label>
                <input type="file" class="form-control" id="excel_lab_dengan_harga" name="excel_lab_dengan_harga" accept=".xls,.xlsx">
                <small>Current file: {{ basename($invoiceLapangan->excel_lab_dengan_harga) }}</small>
            </div>

            <div class="mb-3">
                <label for="teknisi" class="form-label">Pilih Teknisi</label>
                <select class="form-control" id="teknisi" name="teknisi[]" multiple required>
                    <option value="TEKNISI A" @if(in_array('TEKNISI A', explode(',', $invoiceLapangan->teknisi))) selected @endif>TEKNISI A</option>
                    <option value="TEKNISI B" @if(in_array('TEKNISI B', explode(',', $invoiceLapangan->teknisi))) selected @endif>TEKNISI B</option>
                    <option value="TEKNISI C" @if(in_array('TEKNISI C', explode(',', $invoiceLapangan->teknisi))) selected @endif>TEKNISI C</option>
                    <option value="TEKNISI D" @if(in_array('TEKNISI D', explode(',', $invoiceLapangan->teknisi))) selected @endif>TEKNISI D</option>
                    <option value="TEKNISI E" @if(in_array('TEKNISI E', explode(',', $invoiceLapangan->teknisi))) selected @endif>TEKNISI E</option>
                    <option value="TEKNISI F" @if(in_array('TEKNISI F', explode(',', $invoiceLapangan->teknisi))) selected @endif>TEKNISI F</option>
                    <option value="TEKNISI G" @if(in_array('TEKNISI G', explode(',', $invoiceLapangan->teknisi))) selected @endif>TEKNISI G</option>
                    <option value="TEKNISI H" @if(in_array('TEKNISI H', explode(',', $invoiceLapangan->teknisi))) selected @endif>TEKNISI H</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>

    <script src="/dashboard/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="/dashboard/assets/vendor/libs/popper/popper.js"></script>
    <script src="/dashboard/assets/vendor/js/bootstrap.js"></script>
    <script src="/dashboard/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="/dashboard/assets/vendor/js/menu.js"></script>
    <script src="/dashboard/assets/js/main.js"></script>

</body>
</html>

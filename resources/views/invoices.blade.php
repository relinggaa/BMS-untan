<table>
    <thead>
        <tr>
            <th>No</th>
            <th>No Invoice</th>
            <th>Nama Perusahaan</th>
            <th>Nama Proyek</th>
            <th>Permohonan</th>
            <th>Tanggal Datang</th>
            <th>Tanggal Pembayaran ke VA</th>
            <th>Total Harga</th>
            <th>Uang Muka</th>
            <th>Sisa</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($invoices as $index => $invoice)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $invoice->no_invoice }}</td>
                <td>{{ $invoice->nama_perusahaan }}</td>
                <td>{{ $invoice->nama_proyek }}</td>
                <td>{{ $invoice->permohonan }}</td>
                <td>{{ $invoice->tanggal_datang }}</td>
                <td>{{ $invoice->tanggal_pembayaran_va }}</td>
                <td>{{ $invoice->total_harga }}</td>
                <td>{{ $invoice->uang_muka }}</td>
                <td>{{ $invoice->sisa }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<?php

namespace App\Exports;
use App\Models\Invoice;
use App\Models\DataPelanggan; 
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class InvoicesExport implements FromCollection, WithHeadings
{
    protected $startDate;
    protected $endDate;

    public function __construct($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function collection()
    {
        return DataPelanggan::whereBetween('tanggal_datang', [$this->startDate, $this->endDate])
            ->get(['no_invoice', 'nama_perusahaan', 'nama_proyek', 'permohonan', 'tanggal_datang', ]);
    }
    public function exportInvoice()
    {
        return Invoice::whereBetween('tanggal_datang', [$this->startDate, $this->endDate])
            ->get([
                'no_invoice',
                'nama_perusahaan',
                'nama_proyek',
                'permohonan',
                'tanggal_datang',
                'teknisi',
                'jenis_material',
                'jenis_pengujian',
                'jenis_pembayaran',
                'total_biaya',
                'jumlah',
                'bukti_pembayaran',
            ]);
    }
    public function headings(): array
    {
        return [
            'No Invoice',
            'Nama Perusahaan',
            'Nama Proyek',
            'Permohonan',
            'Tanggal Datang',
            'Teknisi',
        ];
    }
}
<?php

namespace App\Exports;

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
            ->get(['no_invoice', 'nama_perusahaan', 'nama_proyek', 'permohonan', 'tanggal_datang', 'teknisi']);
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
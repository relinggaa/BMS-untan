<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class KasExport implements FromCollection, WithHeadings
{
    protected $kasData;

    public function __construct($kasData)
    {
        $this->kasData = $kasData;
    }

    public function collection()
    {
        
        return $this->kasData;
    }

    public function headings(): array
    {
        return [
            'No Bukti',
            'Tanggal',
            'Nama Kegiatan',
            'Nama Perusahaan',
            'Debet',
            'Keterangan',
        ];
    }
}
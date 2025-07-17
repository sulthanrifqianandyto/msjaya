<?php

namespace App\Exports;

use App\Models\Pelanggan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PelangganExport implements FromCollection, WithHeadings
{
    protected $bulan;
    protected $tahun;

    public function __construct($bulan, $tahun)
    {
        $this->bulan = $bulan;
        $this->tahun = $tahun;
    }

    public function collection()
    {
        return Pelanggan::when($this->bulan, function ($query) {
                $query->whereMonth('created_at', $this->bulan);
            })
            ->when($this->tahun, function ($query) {
                $query->whereYear('created_at', $this->tahun);
            })
            ->get(['id', 'nama', 'email', 'created_at']);
    }

    public function headings(): array
    {
        return ['ID', 'Nama', 'Email', 'Tanggal Daftar'];
    }
}

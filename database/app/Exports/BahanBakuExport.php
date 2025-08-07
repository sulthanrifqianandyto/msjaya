<?php

namespace App\Exports;

use App\Models\BahanBaku;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BahanBakuExport implements FromCollection, WithHeadings
{
    protected $filters;

    public function __construct($filters = [])
    {
        $this->filters = $filters;
    }

    public function collection()
    {
        $query = BahanBaku::with(['provinsi', 'kabupaten', 'kecamatan', 'kelurahan']);

        if (!empty($this->filters['tanggal_awal']) && !empty($this->filters['tanggal_akhir'])) {
            $query->whereBetween('tanggal_masuk', [$this->filters['tanggal_awal'], $this->filters['tanggal_akhir']]);
        }

        if (!empty($this->filters['kabupaten_id'])) {
            $query->where('kabupaten_id', $this->filters['kabupaten_id']);
        }

        return $query->get()->map(function ($bahan) {
            return [
                $bahan->nama_bahan,
                $bahan->stok,
                $bahan->tanggal_masuk,
                $bahan->alamat_suplier,
                ($bahan->kelurahan->nama ?? '-') . ', ' .
                ($bahan->kecamatan->nama ?? '-') . ', ' .
                ($bahan->kabupaten->nama ?? '-') . ', ' .
                ($bahan->provinsi->nama ?? '-'),
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Nama Bahan',
            'Stok',
            'Tanggal Masuk',
            'Alamat Suplier',
            'Wilayah',
        ];
    }
}

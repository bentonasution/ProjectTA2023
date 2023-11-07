<?php

namespace App\Exports;

use App\Models\Transaksi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class TransaksiExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    private $rowNumber = 0;

    public function collection()
    {
        return Transaksi::with('users', 'buku')->get();
    }

    public function map($transaksi): array
    {
        $this->rowNumber++;

        return [
            $this->rowNumber,
            $transaksi->users->id,
            $transaksi->users->nama,
            $transaksi->buku->judul,
            $transaksi->tglpinjam,
            $transaksi->tempo,
            $transaksi->tglkembali,
            $transaksi->denda,
            $transaksi->status,
        ];
    }

    public function headings(): array
    {
        return [
            'No',
            'Nomor Peminjam',
            'Nama Peminjam',
            'Buku yang di Pinjam',
            'Tanggal Pinjam',
            'Tempo',
            'Tanggal Kembali',
            'Denda',
            'Status',
        ];
    }
}

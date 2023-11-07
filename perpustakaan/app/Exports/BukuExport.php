<?php

namespace App\Exports;

use App\Models\Buku;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping; // Import WithMapping
use Maatwebsite\Excel\Concerns\ShouldAutoSize; // Import ShouldAutoSize

class BukuExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    private $rowNumber = 0;

    public function collection()
    {
        return Buku::with('kategori')->get();
    }

    public function map($buku): array
    {
        $this->rowNumber++;

        return [
            $this->rowNumber,
            $buku->judul,
            $buku->pengarang,
            $buku->isbn,
            $buku->jmlhal,
            $buku->jmlbuku,
            $buku->tahun,
            $buku->penerbit,
            $buku->kategori->nama,
            $buku->rak,
            $buku->sinopsis,
            $buku->foto,
        ];
    }

    public function headings(): array
    {
        return [
            'No',
            'Judul',
            'Pengarang',
            'ISBN',
            'Jumlah Halaman',
            'Jumlah Buku',
            'Tahun Terbit',
            'Penerbit',
            'Kategori',
            'Rak',
            'Sinopsis',
            'Foto',
        ];
    }
}

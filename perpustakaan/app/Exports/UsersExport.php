<?php

namespace App\Exports;

use App\Models\Users;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class UsersExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    private $rowNumber = 0;

    public function collection()
    {
        return Users::all();
    }

    public function map($users): array
    {
        $this->rowNumber++;

        return [
            $this->rowNumber,
            $users->nama,
            $users->nik,
            $users->kelas ?: '-',
            $users->jurusan ? $users->jurusan->nama_prodi : '-',
            $users->nohp,
            $users->email,
            $users->status,
            $users->foto,
        ];
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama',
            'NIK',
            'Kelas',
            'Prodi',
            'No HP',
            'Email',
            'Status',
            'Foto',
        ];
    }
}

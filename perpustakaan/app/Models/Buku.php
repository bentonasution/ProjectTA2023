<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    protected $table = 'buku';

    protected $fillable = ['id_judul', 'id_kategori', 'penerbit', 'rak', 'judul', 'pengarang', 'isbn', 'jmlhal', 'jmlbuku', 'tahun', 'sinopsis', 'foto'];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'id_judul');
    }

    public function hitungPeminjaman()
    {
        return $this->transaksi()->where('status', 'pinjam')->count();
    }

    public function hitungPemesanan()
    {
        return $this->transaksi()->where('status', 'dipesan')->count();
    }
}

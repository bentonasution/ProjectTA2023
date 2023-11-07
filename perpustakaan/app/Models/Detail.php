<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    use HasFactory;
  
    protected $table = 'buku';

    protected $fillable = ['id_buku', 'id_kategori', 'id_penerbit', 'id_rak', 'judul', 'pengarang', 'isbn', 'jmlhal', 'jmlbuku', 'tahun', 'sinopsis', 'foto'];
    
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }

    public function penerbit()
    {
        return $this->belongsTo(Penerbit::class, 'id_penerbit');
    }

    public function rak()
    {
        return $this->belongsTo(Rak::class, 'id_rak');
    }

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'id_judul');
    }
}
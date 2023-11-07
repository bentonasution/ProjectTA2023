<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    use HasFactory;

    protected $table = 'transaksi';

    protected $fillable = ['id_nama', 'id_judul', 'status'];

    public function Buku()
    {
        return $this->belongsTo(Buku::class, 'id_judul');
    }

    public function Users()
    {
        return $this->belongsTo(Users::class, 'id_nama');
    }
  
}
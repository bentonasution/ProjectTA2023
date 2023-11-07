<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    use HasFactory;

    protected $table = 'jurusan';

    protected $fillable = ['nama_prodi', 'keterangan'];

    public function users()
    {
        return $this->hasMany(Users::class, 'id_prodi');
    }
  
}
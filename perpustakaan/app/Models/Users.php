<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    use HasFactory;

    protected $table = 'users';

    protected $fillable = ['nama', 'nik', 'kelas', 'id_prodi', 'nohp', 'email', 'status', 'foto', 'password', 'remember_token', 'role'];

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'id_nama');
    }

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'id_prodi');
    }
    
}
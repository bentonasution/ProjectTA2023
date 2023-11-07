<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $table = 'users';

    protected $fillable = ['nama', 'nik', 'kelas', 'prodi', 'nohp', 'email', 'status', 'foto', 'password', 'status', 'remember_token'];
  
    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'id_nama');
    }
}
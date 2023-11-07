<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersSiswa extends Model
{
    use HasFactory;

    protected $table = 'users';

    protected $fillable = ['nama', 'nik', 'kelas', 'id_prodi', 'nohp', 'email', 'status', 'foto', 'password', 'remember_token'];

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'id_prodi');
    }
}
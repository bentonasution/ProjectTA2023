<?php

namespace App\Http\Controllers;


use App\Models\Rak;
use App\Models\Buku;
use App\Models\Detail;
use App\Models\Kategori;
use App\Models\Penerbit;
use Illuminate\Http\Request;

class DetailController extends Controller
{
    public function detail($id)
    {
        $buku = Buku::find($id);
        $kategori = Kategori::get();

        return view('detail', ['buku'=>$buku, 'kategori'=>$kategori]);
    }
}
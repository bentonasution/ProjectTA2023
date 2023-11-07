<?php

namespace App\Http\Controllers;


use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index(Request $request)
    {

        if($request->has('search')) {
            $kategori = Kategori::where('nama', 'like', '%' . $request->search . '%')->paginate(10);
        } else{
            $kategori = Kategori::paginate(10);
        }
        

        return view('kategori.index', ['data' => $kategori]);
    }

    public function tambah()
    {
        return view('kategori.form');
    }

    public function edit($id)
    {
        $kategori = Kategori::find($id);

        return view('kategori.form', ['kategori'=>$kategori]);
    }

    public function simpan(Request $request)
    {
        Kategori::create($request->all());

        return redirect()->route('kategori')->with('success', 'Data Berhasil Di Tambah');
    }

    public function update(Request $request, $id)
    {
        // $data = Buku::find($request->all());
        $data = Kategori::find($id);
        $data->update($request->all());
            $data->save();
        

        return redirect()->route('kategori')->with('success', 'Data Berhasil Di Edit');
    }

    public function hapus($id)
    {
        Kategori::find($id)->delete();

        return redirect()->route('kategori');
    }
}
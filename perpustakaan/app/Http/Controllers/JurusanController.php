<?php

namespace App\Http\Controllers;


use App\Models\Jurusan;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    public function index(Request $request)
    {

        if($request->has('search')) {
            $jurusan = Jurusan::where('nama_prodi', 'like', '%' . $request->search . '%')->paginate(10);
        } else{
            $jurusan = Jurusan::paginate(10);
        }
        

        return view('jurusan.index', ['data' => $jurusan]);
    }

    public function tambah()
    {
        return view('jurusan.form');
    }

    public function edit($id)
    {
        $jurusan = Jurusan::find($id);

        return view('jurusan.form', ['jurusan'=>$jurusan]);
    }

    public function simpan(Request $request)
    {
        Jurusan::create($request->all());

        return redirect()->route('jurusan')->with('success', 'Data Berhasil Di Tambah');
    }

    public function update(Request $request, $id)
    {
        // $data = Buku::find($request->all());
        $data = Jurusan::find($id);
        $data->update($request->all());
            $data->save();
        

        return redirect()->route('jurusan')->with('success', 'Data Berhasil Di Edit');
    }

    public function hapus($id)
    {
        Jurusan::find($id)->delete();

        return redirect()->route('jurusan');
    }
}
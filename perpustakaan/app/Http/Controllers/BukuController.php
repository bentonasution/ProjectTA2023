<?php

namespace App\Http\Controllers;


use App\Models\Rak;
use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Penerbit;
use Barryvdh\DomPDF\PDF;
use App\Exports\BukuExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class BukuController extends Controller
{
    public function index(Request $request)
    {
    $query = Buku::query();

    if ($request->has('search')) {
        $query->where('judul', 'like', '%' . $request->search . '%')
            ->orWhere('penerbit', 'like', '%' . $request->search . '%')
            ->orWhere('rak', 'like', '%' . $request->search . '%')
            ->orWhereHas('kategori', function ($query) use ($request) {
                $query->where('nama', 'like', '%' . $request->search . '%');
            });
    }

    if ($request->has('kategori')) {
        $query->whereHas('kategori', function ($query) use ($request) {
            $query->where('id', $request->kategori);
        });
    }

    $data = $query->paginate(10);
    $kategori = Kategori::all(); // Ambil semua kategori

    return view('buku.index', ['data' => $data, 'kategori' => $kategori]);
    }

    public function tambah()
    {
        $kategori = Kategori::get();

        return view('buku.form', ['kategori' => $kategori]);
    }
    //-------kode sebelumnya--------
    // public function simpan(Request $request)
    // {
    //     $data = [
    //         'judul'=>$request->judul,
    //         'id_kategori'=>$request->id_kategori,
    //         'pengarang'=>$request->pengarang,
    //         'isbn'=>$request->isbn,
    //         'jmlhal'=>$request->jmlhal,
    //         'jmlbuku'=>$request->jmlbuku,
    //         'tahun'=>$request->tahun,
    //         'sinopsis'=>$request->sinopsis,
    //         'id_penerbit'=>$request->id_penerbit,
    //         'id_rak'=>$request->id_rak,
    //         'foto'=>$request->foto,
    //     ];

    //     Buku::create($data);

    //     return redirect()->route('buku');
    // }
    public function simpan(Request $request)
{
    // Validate the incoming request data
    $request->validate([
        'judul' => 'required|string|max:255',
        'id_kategori' => 'required|integer',
        'pengarang' => 'required|string|max:255',
        'isbn' => 'required|string',
        'jmlhal' => 'required|integer',
        'jmlbuku' => 'required|integer',
        'tahun' => 'required|string',
        'penerbit' => 'required|string',
        'rak' => 'required|string',
        // 'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Change the image type and size restrictions if necessary
    ]);

    $databuku = [
        'judul' => $request->judul,
        'id_kategori' => $request->id_kategori,
        'pengarang' => $request->pengarang,
        'isbn' => $request->isbn,
        'jmlhal' => $request->jmlhal,
        'jmlbuku' => $request->jmlbuku,
        'tahun' => $request->tahun,
        'sinopsis' => $request->sinopsis,
        'penerbit' => $request->penerbit,
        'rak' => $request->rak,
        'foto' => $request->foto,
    ];

    $data = Buku::create($databuku);

    if ($request->hasFile('foto')) {
        $request->file('foto')->move('bukuimages/', $request->file('foto')->getClientOriginalName());
        $data->foto = $request->file('foto')->getClientOriginalName();
        $data->save();
    }

    return redirect()->route('buku')->with('success', 'Data Berhasil Di Tambah');
}


    public function edit($id)
    {
        $buku = Buku::find($id);
        $kategori = Kategori::get();

        return view('buku.form', ['buku'=>$buku, 'kategori'=>$kategori]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'id_kategori' => 'required|integer',
            'pengarang' => 'required|string|max:255',
            'isbn' => 'required|string',
            'jmlhal' => 'required|integer',
            'jmlbuku' => 'required|integer',
            'tahun' => 'required|date_format:Y',
            'penerbit' => 'required|string',
            'rak' => 'required|string',
            // 'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Change the image type and size restrictions if necessary
        ]);
        
        $databuku = [
            'judul' => $request->judul,
            'id_kategori' => $request->id_kategori,
            'pengarang' => $request->pengarang,
            'isbn' => $request->isbn,
            'jmlhal' => $request->jmlhal,
            'jmlbuku' => $request->jmlbuku,
            'tahun' => $request->tahun,
            'sinopsis' => $request->sinopsis,
            'penerbit' => $request->penerbit,
            'rak' => $request->rak,
        ];

        // $data = Buku::find($request->all());
        $data = Buku::find($id);
        $data->update($databuku);
        if($request->hasFile('foto')){
            $request->file('foto')->move('bukuimages/', $request->file('foto')->getClientOriginalName());
            $data->foto =$request->file('foto')->getClientOriginalName();
            $data->save();
        }
        return redirect()->route('buku')->with('success', 'Data Berhasil Di Edit');
    }

    public function hapus($id)
    {
        Buku::find($id)->delete();

        return redirect()->route('buku');
    }

    public function exportpdf()
    {
        $data = Buku::all();

        $pdf = app('dompdf.wrapper');
        $pdf->loadView('buku.databuku-pdf', ['data' => $data]); // Gantilah 'databuku-pdf' dengan nama tampilan yang ingin Anda gunakan dan 'data' dengan data yang ingin Anda kirimkan ke tampilan
    
        return $pdf->download('databuku.pdf');
    }
    
    public function exportexcel() 
    {
        return Excel::download(new BukuExport, 'databuku.xlsx');
    }
}
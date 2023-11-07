<?php

namespace App\Http\Controllers;


use App\Models\Rak;
use App\Models\Buku;
use App\Models\Users;
use App\Models\Kategori;
use App\Models\Penerbit;
use App\Models\BukuSiswa;
use App\Models\Pemesanan;
use Illuminate\Http\Request;

class BukuSiswaController extends Controller
{
    public function index(Request $request)
    {
    $query = BukuSiswa::query();

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

    return view('bukusiswa.index', ['data' => $data, 'kategori' => $kategori]);
    }

    public function tambah()
    {
        $buku = Buku::get();
        $users = Users::get();

        return view('bukusiswa.form', ['buku' => $buku, 'users' => $users]);
    }

    public function simpan(Request $request)
{
    // Validate the incoming request data
    $request->validate([
        'id_judul' => 'required|string',
        'status' => 'required|string',
        // 'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Change the image type and size restrictions if necessary
    ]);

    // Count the existing 'Pinjam' transactions for the selected user
    $pinjamCount = Pemesanan::where('id_nama', $request->id_nama)
                            ->where('status', 'Pinjam')
                            ->count();

    // Check if the user has exceeded the maximum allowed 'Pinjam' transactions
    if ($request->status === 'Pinjam' && $pinjamCount >= 2) {
        return redirect()->back()->withInput()->withErrors(['status' => 'Peminjam sudah mencapai batas maksimal transaksi "Pinjam".']);
    }

    // Get the selected book
    $selectedBook = BukuSiswa::findOrFail($request->id_judul);

    // Count the total number of 'Pinjam' and 'Dipesan' transactions for the selected book
    $totalDipinjamDanDipesan = $selectedBook->hitungPeminjaman() + $selectedBook->hitungPemesanan();

    // Check if the total number of 'Pinjam' and 'Dipesan' transactions exceeds the available books
    if ($totalDipinjamDanDipesan >= $selectedBook->jmlbuku) {
        return redirect()->back()->withInput()->withErrors(['status' => 'Maaf, Buku saat ini sudah tidak tersedia, Karna sudah dipinjam/dipesan']);
    }

    $datatransaksi = [
        'id_nama' => $request->id_nama,
        'id_judul' => $request->id_judul,
        'status' => $request->status,
    ];

    $data = Pemesanan::create($datatransaksi);

    if ($request->hasFile('foto')) {
        $request->file('foto')->move('images/', $request->file('foto')->getClientOriginalName());
        $data->foto = $request->file('foto')->getClientOriginalName();
        $data->save();
    }

    return redirect()->route('bukusiswa')->with('success', 'Berhasil Melakukan Pemesanan');
}

}
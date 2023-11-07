<?php

namespace App\Http\Controllers;



use Carbon\Carbon;
use App\Models\Buku;
use App\Models\Users;
use Illuminate\Http\Request;
use App\Exports\TransaksiExport;
use App\Models\TransaksiDipesan;
use Maatwebsite\Excel\Facades\Excel;

class TransaksiDipesanController extends Controller
{
    public function index(Request $request)
    {

        if ($request->has('search')) {
            $transaksi = TransaksiDipesan::whereHas('users', function ($query) use ($request) {
                $query->where('nama', 'like', '%' . $request->search . '%');
            })
            ->orWhereHas('buku', function ($query) use ($request) {
                $query->where('judul', 'like', '%' . $request->search . '%');
            })
            ->orWhere('status', 'like', '%' . $request->search . '%')
            ->paginate(10);
        } else {
            $transaksi = TransaksiDipesan::paginate(10);
        }


        return view('transaksidipesan.index', ['data' => $transaksi]);
    }

    public function tambah()
    {
        $buku = Buku::get();
        $users = Users::get();

        return view('transaksidipesan.form', ['buku' => $buku, 'users' => $users]);
    }

    public function simpan(Request $request)
{
    // Validate the incoming request data
    $request->validate([
        'id_nama' => 'required|string',
        'id_judul' => 'required|string',
        'tglpinjam' => 'required|date',
        'tempo' => 'required|date',
        'status' => 'required|string',
        // 'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Change the image type and size restrictions if necessary
    ]);

    // Count the existing 'Pinjam' transactions for the selected user
    $pinjamCount = TransaksiDipesan::where('id_nama', $request->id_nama)
                            ->where('status', 'Pinjam')
                            ->count();

    // Check if the user has exceeded the maximum allowed 'Pinjam' transactions
    if ($request->status === 'Pinjam' && $pinjamCount >= 2) {
        return redirect()->back()->withInput()->withErrors(['status' => 'Peminjam sudah mencapai batas maksimal transaksi "Pinjam".']);
    }

    $datatransaksi = [
        'id_nama' => $request->id_nama,
        'id_judul' => $request->id_judul,
        'tglpinjam' => $request->tglpinjam,
        'tempo' => $request->tempo,
        'tglkembali' => $request->tglkembali,
        'denda' => $request->denda,
        'status' => $request->status,
    ];

    $data = TransaksiDipesan::create($datatransaksi);

    if ($request->hasFile('foto')) {
        $request->file('foto')->move('images/', $request->file('foto')->getClientOriginalName());
        $data->foto = $request->file('foto')->getClientOriginalName();
        $data->save();
    }

    return redirect()->route('transaksidipesan')->with('success', 'Data Berhasil Di Tambah');
    }

    public function edit($id)
    {

        $transaksi = TransaksiDipesan::find($id);
        $buku = Buku::all();
        $users = Users::all();

        $nomorPeminjaman = $transaksi->nomor_peminjaman;

        return view('transaksidipesan.form', ['transaksi' => $transaksi, 'buku' => $buku, 'users' => $users, 'nomorPeminjaman' => $nomorPeminjaman]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_nama' => 'required|string',
            'id_judul' => 'required|string',
            'tglpinjam' => 'required|date',
            'tempo' => 'required|date',
            'status' => 'required|string',
            // 'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Change the image type and size restrictions if necessary
        ]);

        $datatransaksi = [
            'id_nama' => $request->id_nama,
            'id_judul' => $request->id_judul,
            'tglpinjam' => $request->tglpinjam,
            'tempo' => $request->tempo,
            'tglkembali' => $request->tglkembali,
            'denda' => $request->denda,
            'status' => $request->status,
        ];

        // $data = Buku::find($request->all());
        $data = TransaksiDipesan::find($id);
        $data->update($datatransaksi);
        if ($request->hasFile('foto')) {
            $request->file('foto')->move('images/', $request->file('foto')->getClientOriginalName());
            $data->foto = $request->file('foto')->getClientOriginalName();
            $data->save();
        }
        return redirect()->route('transaksidipesan')->with('success', 'Data Berhasil Di Edit');
    }

    public function hapus($id)
    {
        TransaksiDipesan::find($id)->delete();

        return redirect()->route('transaksidipesan');
    }

    public function exportpdf()
    {
        $data = TransaksiDipesan::all();

        $pdf = app('dompdf.wrapper');
        $pdf->loadView('transaksi.datatransaksi-pdf', ['data' => $data]); // Gantilah 'databuku-pdf' dengan nama tampilan yang ingin Anda gunakan dan 'data' dengan data yang ingin Anda kirimkan ke tampilan

        return $pdf->download('datatransaksi.pdf');
    }

    public function exportexcel()
    {
        return Excel::download(new TransaksiExport, 'datatransaksi.xlsx');
    }
    
}

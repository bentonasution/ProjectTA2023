<?php

namespace App\Http\Controllers;



use Carbon\Carbon;
use App\Models\Buku;
use App\Models\Users;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Exports\TransaksiExport;
use Maatwebsite\Excel\Facades\Excel;

class TransaksiController extends Controller
{
    public function index(Request $request)
    {

        if ($request->has('search')) {
            $transaksi = Transaksi::whereHas('users', function ($query) use ($request) {
                $query->where('nama', 'like', '%' . $request->search . '%');
            })
            ->orWhereHas('buku', function ($query) use ($request) {
                $query->where('judul', 'like', '%' . $request->search . '%');
            })
            ->orWhere('status', 'like', '%' . $request->search . '%')
            ->paginate(10);
        } else {
            $transaksi = Transaksi::paginate(10);
        }
        


        return view('transaksi.index', ['data' => $transaksi]);
    }

    public function tambah()
    {
        $buku = Buku::get();
        $users = Users::get();

        return view('transaksi.form', ['buku' => $buku, 'users' => $users]);
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
    $pinjamCount = Transaksi::where('id_nama', $request->id_nama)
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

    $data = Transaksi::create($datatransaksi);

    if ($request->hasFile('foto')) {
        $request->file('foto')->move('images/', $request->file('foto')->getClientOriginalName());
        $data->foto = $request->file('foto')->getClientOriginalName();
        $data->save();
    }

    return redirect()->route('transaksi')->with('success', 'Data Berhasil Di Tambah');
}



    public function edit($id)
    {

        $transaksi = Transaksi::find($id);
        $buku = Buku::all();
        $users = Users::all();

        return view('transaksi.form', ['transaksi' => $transaksi, 'buku' => $buku, 'users' => $users]);
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

        $pinjamCount = Transaksi::where('id_nama', $request->id_nama)
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

        // $data = Buku::find($request->all());
        $data = Transaksi::find($id);
        $data->update($datatransaksi);
        if ($request->hasFile('foto')) {
            $request->file('foto')->move('images/', $request->file('foto')->getClientOriginalName());
            $data->foto = $request->file('foto')->getClientOriginalName();
            $data->save();
        }
        return redirect()->route('transaksi')->with('success', 'Data Berhasil Di Edit');
    }

    public function hapus($id)
    {
        Transaksi::find($id)->delete();

        return redirect()->route('transaksi');
    }

    public function exportpdf()
    {
        $data = Transaksi::all();

        $pdf = app('dompdf.wrapper');
        $pdf->loadView('transaksi.datatransaksi-pdf', ['data' => $data]); // Gantilah 'databuku-pdf' dengan nama tampilan yang ingin Anda gunakan dan 'data' dengan data yang ingin Anda kirimkan ke tampilan

        return $pdf->download('datatransaksi.pdf');
    }

    public function exportexcel()
    {
        return Excel::download(new TransaksiExport, 'datatransaksi.xlsx');
    }
    
}

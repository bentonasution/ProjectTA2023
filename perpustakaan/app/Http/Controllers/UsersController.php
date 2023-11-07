<?php

namespace App\Http\Controllers;


use App\Models\Users;
use App\Models\Jurusan;
use App\Charts\DataChart;
use App\Models\Transaksi;
use Illuminate\Support\Str;
use App\Exports\UsersExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;


class UsersController extends Controller
{
    public function index(Request $request)
    {

        if ($request->has('search')) {
            $users = Users::where('nama', 'like', '%' . $request->search . '%')
                        ->orWhere('kelas', 'like', '%' . $request->search . '%')
                        ->orWhereHas('jurusan', function ($query) use ($request) {
                            $query->where('nama_prodi', 'like', '%' . $request->search . '%');
                        })
                        ->orWhere('status', 'like', '%' . $request->search . '%')
                        ->paginate(10);        
        } else{
            $users = Users::paginate(10);
        }
        

        return view('users.index', ['data' => $users]);
    }

    public function tambah()
    {
        $jurusan = Jurusan::get();

        return view('users.form', ['jurusan'=>$jurusan]);
    }

    public function edit($id)
    {
        $users = Users::find($id);
        $jurusan = Jurusan::get();

        return view('users.form', ['users'=>$users, 'jurusan'=>$jurusan]);
    }

    public function simpan(Request $request)
    {

        $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|integer',
            'email' => 'required|string',
            'status' => 'required|string',
            'role' => 'required|string',
            'password' => 'required|string|min:6',
            // 'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Change the image type and size restrictions if necessary
        ]);

        $datausers = [
            'nama' => $request->nama,
            'nik' => $request->nik,
            'kelas' => $request->kelas,
            'id_prodi' => $request->id_prodi,
            'nohp' => $request->nohp,
            'email' => $request->email,
            'foto' => $request->foto,
            'status' => $request->status,
            'password' => bcrypt($request->password),
            'role' =>$request->role,
            'remember_token' => Str::random(60),
        ];

        $data = Users::create($datausers);

        if ($request->hasFile('foto')) {
            $request->file('foto')->move('images/', $request->file('foto')->getClientOriginalName());
            $data->foto = $request->file('foto')->getClientOriginalName();
            $data->save();
        }
        // if ($request->hasFile('foto')) {
        //     $fileName = $request->file('foto')->getClientOriginalName();
        //     $request->file('foto')->move('images/', $fileName);
        //     $data->foto = $fileName;
        //     $data->save();
        // } else {
        //     // Jika foto tidak diunggah, set foto default atau custom
        //     $data->foto = 'img/undraw_profile.svg'; // Ganti dengan nama file default atau custom yang sesuai
        //     $data->save();
        // }

        return redirect()->route('users')->with('success', 'Data Berhasil Di Tambah');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|integer',
            'email' => 'required|string',
            'status' => 'required|string',
            // 'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Change the image type and size restrictions if necessary
        ]);

        $datausers = [
            'nama' => $request->nama,
            'nik' => $request->nik,
            'kelas' => $request->kelas,
            'id_prodi' => $request->id_prodi,
            'nohp' => $request->nohp,
            'email' => $request->email,
            'status' => $request->status,
            'remember_token' => Str::random(60),
        ];
        // $data = Buku::find($request->all());
        $data = Users::find($id);
        $data->update($datausers);
        if($request->hasFile('foto')){
            $request->file('foto')->move('images/', $request->file('foto')->getClientOriginalName());
            $data->foto =$request->file('foto')->getClientOriginalName();
            $data->save();
        }
        return redirect()->route('users')->with('success', 'Data Berhasil Di Edit');
    }

    public function hapus($id)
    {
        Users::find($id)->delete();

        return redirect()->route('users');
    }

    public function exportpdf()
    {
        $data = Users::all();

        $pdf = app('dompdf.wrapper');
        $pdf->loadView('users.datausers-pdf', ['data' => $data]); // Gantilah 'databuku-pdf' dengan nama tampilan yang ingin Anda gunakan dan 'data' dengan data yang ingin Anda kirimkan ke tampilan
    
        return $pdf->download('datausers.pdf');
    }
    
    public function exportexcel() 
    {
        return Excel::download(new UsersExport, 'datausers.xlsx');
    }
}
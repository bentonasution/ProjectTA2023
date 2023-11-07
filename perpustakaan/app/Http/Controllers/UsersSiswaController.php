<?php

namespace App\Http\Controllers;


use App\Models\UsersSiswa;
use Illuminate\Support\Str;
use Illuminate\Http\Request;


class UsersSiswaController extends Controller
{
    public function index(Request $request)
    {

        if($request->has('search')) {
            $userssiswa = UsersSiswa::where('nama', 'like', '%' . $request->search . '%')
            ->orWhere('kelas', 'like', '%' . $request->search . '%')
            ->orWhere('prodi', 'like', '%' . $request->search . '%')
            ->orWhere('status', 'like', '%' . $request->search . '%')->paginate(10);
        } else{
            $userssiswa = UsersSiswa::paginate(10);
        }
        

        return view('userssiswa.index', ['data' => $userssiswa]);
    }
}
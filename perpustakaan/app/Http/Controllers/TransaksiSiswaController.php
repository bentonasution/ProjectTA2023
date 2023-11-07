<?php

namespace App\Http\Controllers;



use Carbon\Carbon;
use App\Models\Buku;
use App\Models\Users;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Models\TransaksiSiswa;
use App\Exports\TransaksiExport;
use Maatwebsite\Excel\Facades\Excel;

class TransaksiSiswaController extends Controller
{
    public function index(Request $request)
    {

        if ($request->has('search')) {
            $transaksisiswa = TransaksiSiswa::whereHas('users', function ($query) use ($request) {
                $query->where('nama', 'like', '%' . $request->search . '%');
            })->orWhere('status', 'like', '%' . $request->search . '%')->paginate(10);
        } else {
            $transaksisiswa = TransaksiSiswa::paginate(10);
        }


        return view('transaksisiswa.index', ['data' => $transaksisiswa]);
    }
}
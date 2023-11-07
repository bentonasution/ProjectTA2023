<?php

namespace App\Http\Controllers;


use App\Models\Dashboard;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    public function index()
    {
        $jumlahbuku = 50; // Contoh nilai, gantilah dengan nilai sesuai kebutuhan Anda
        $jumlahpengguna = 100; // Contoh nilai
        $jumlahtransaksi = 200; // Contoh nilai
        $jumlahkategori = 5; // Contoh nilai kategori, gantilah sesuai kebutuhan Anda

        return view('dashboard', compact('jumlahbuku', 'jumlahpengguna', 'jumlahtransaksi', 'jumlahkategori', 'jumlahDipinjam'));
    }
}
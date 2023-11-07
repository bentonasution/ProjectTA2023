<?php

use App\Models\Buku;
use App\Models\Users;
use App\Models\Transaksi;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransaksiKembaliController;
use App\Http\Controllers\TransaksiDipesanController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\BukuSiswaController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Routing\Route as RoutingRoute;
use App\Http\Controllers\UsersSiswaController;
use App\Http\Controllers\TransaksiSiswaController;
use App\Models\Kategori;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('dashboard', function () {
    $user = Auth::user();
    $jumlahbuku = Buku::count();
    $jumlahpengguna = Users::count();
    $jumlahtransaksi = Transaksi::count();
    $jumlahkategori = Kategori::count();

    return view('dashboard', compact('jumlahbuku', 'jumlahpengguna', 'jumlahtransaksi', 'jumlahkategori'));
})->name('dashboard')->middleware('auth');

Route::controller(LoginController::class)->group(function() {
    Route::get('/login', 'halamanlogin')->name('login');
    Route::post('/postlogin', 'postlogin')->name('postlogin');
    Route::get('/logout', 'logout')->name('logout');

});

Route::group(['middleware' => ['auth', 'hakakses:admin,petugas']], function() {

Route::controller(BukuController::class)->prefix('buku')->group(function() {
    Route::get('/', 'index')->name('buku')->middleware('auth');
    Route::get('/tambah', 'tambah')->name('buku.tambah');
    Route::post('/tambah', 'simpan')->name('buku.tambah.simpan');
    Route::get('/edit/{id}', 'edit')->name('buku.edit');
    Route::post('/edit/{id}', 'update')->name('buku.tambah.update');
    Route::get('/hapus/{id}', 'hapus')->name('buku.hapus');
    Route::get('/exportexcel', 'exportexcel')->name('buku.exportexcel');
    Route::get('/exportpdf', 'exportpdf')->name('buku.exportpdf');
});

Route::controller(KategoriController::class)->prefix('kategori')->group(function() {
    Route::get('', 'index')->name('kategori')->middleware('auth');
    Route::get('/tambah', 'tambah')->name('kategori.tambah');
    Route::post('/tambah', 'simpan')->name('kategori.tambah.simpan');
    Route::get('/edit/{id}', 'edit')->name('kategori.edit');
    Route::post('/edit/{id}', 'update')->name('kategori.tambah.update');
    Route::get('/hapus/{id}', 'hapus')->name('kategori.hapus');
});

Route::controller(TransaksiController::class)->prefix('transaksi')->group(function() {
    Route::get('/', 'index')->name('transaksi')->middleware('auth');
    Route::get('/tambah', 'tambah')->name('transaksi.tambah');
    Route::post('/tambah', 'simpan')->name('transaksi.tambah.simpan');
    Route::get('/edit/{id}', 'edit')->name('transaksi.edit');
    Route::post('/edit/{id}', 'update')->name('transaksi.tambah.update');
    Route::get('/hapus/{id}', 'hapus')->name('transaksi.hapus');
    Route::get('/exportexcel', 'exportexcel')->name('transaksi.exportexcel');
    Route::get('/exportpdf', 'exportpdf')->name('transaksi.exportpdf');
});

Route::controller(TransaksiDipesanController::class)->prefix('transaksidipesan')->group(function() {
    Route::get('/', 'index')->name('transaksidipesan')->middleware('auth');
    Route::get('/tambah', 'tambah')->name('transaksidipesan.tambah');
    Route::post('/tambah', 'simpan')->name('transaksidipesan.tambah.simpan');
    Route::get('/edit/{id}', 'edit')->name('transaksidipesan.edit');
    Route::post('/edit/{id}', 'update')->name('transaksidipesan.tambah.update');
    Route::get('/hapus/{id}', 'hapus')->name('transaksidipesan.hapus');
});


});

Route::group(['middleware' => ['auth', 'hakakses:admin']], function() {

Route::controller(UsersController::class)->prefix('users')->group(function() {
    Route::get('/', 'index')->name('users')->middleware('auth');
    Route::get('/tambah', 'tambah')->name('users.tambah');
    Route::post('/tambah', 'simpan')->name('users.tambah.simpan');
    Route::get('/edit/{id}', 'edit')->name('users.edit');
    Route::post('/edit/{id}', 'update')->name('users.tambah.update');
    Route::get('/hapus/{id}', 'hapus')->name('users.hapus');
    Route::get('/exportexcel', 'exportexcel')->name('users.exportexcel');
    Route::get('/exportpdf', 'exportpdf')->name('users.exportpdf');
});

Route::controller(JurusanController::class)->prefix('jurusan')->group(function() {
    Route::get('', 'index')->name('jurusan')->middleware('auth');
    Route::get('/tambah', 'tambah')->name('jurusan.tambah');
    Route::post('/tambah', 'simpan')->name('jurusan.tambah.simpan');
    Route::get('/edit/{id}', 'edit')->name('jurusan.edit');
    Route::post('/edit/{id}', 'update')->name('jurusan.tambah.update');
    Route::get('/hapus/{id}', 'hapus')->name('jurusan.hapus');
});

});

Route::group(['middleware' => ['auth', 'hakakses:user']], function() {

Route::controller(BukuSiswaController::class)->prefix('bukusiswa')->group(function() {
    Route::get('/', 'index')->name('bukusiswa')->middleware('auth');
    Route::get('/tambah', 'tambah')->name('pemesanan.tambah');
    Route::post('/tambah', 'simpan')->name('pemesanan.tambah.simpan');
});

Route::controller(DetailController::class)->prefix('detail')->group(function() {
    Route::get('/detail/{id}', 'detail')->name('detail')->middleware('auth');

});

Route::controller(UsersSiswaController::class)->prefix('userssiswa')->group(function() {
    Route::get('/', 'index')->name('userssiswa')->middleware('auth');
});

Route::controller(TransaksiSiswaController::class)->prefix('transaksisiswa')->group(function() {
    Route::get('/', 'index')->name('transaksisiswa')->middleware('auth');
});

});

Route::controller(ProfileController::class)->prefix('profile')->group(function() {
    Route::get('/', 'profile')->name('profile')->middleware('auth');

});

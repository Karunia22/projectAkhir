<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CRUD;
use App\Http\Controllers\PembeliController;
use App\Http\Controllers\PenjualController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('halamanSatu');
})->name('cek');
Route::get('/s', function () {
    return view('pembeli.beranda');
})->name('cek');

// Route::get('/dashboard', function () {
//     return view('admin.admin');
// })->middleware( ['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'berandaAdmin'])->name('adminBeranda');
    //kategori
    Route::get('/admin/kategori', [AdminController::class, 'kategori'])->name('kategori');
    Route::get('/admin/kategori/tambahKategori', [AdminController::class, 'tambahKategori'])->name('tambahKategori');
    Route::post('/admin/kategori/terimaInputKategori', [AdminController::class, 'terimaInputKategori'])->name('terimaInputKategori');
    Route::delete('/admin/kategori/hapusKategori', [AdminController::class, 'hapusKategori'])->name('hapusKategori');
    Route::get('/admin/kategori/editKategori/{id}', [AdminController::class, 'editKategori'])->name('editKategori');
    Route::put('/admin/kategori/updateKategori', [AdminController::class, 'updateKategori'])->name('updateKategori');
    //penjual
    Route::get('/admin/penjual', [AdminController::class, 'penjual'])->name('penjual');
    Route::get('/admin/penjual/tambahPenjual', [AdminController::class, 'tambahPenjual'])->name('tambahPenjual');
    Route::post('/admin/penjual/terimaInputPenjual', [AdminController::class, 'terimaInputPenjual'])->name('terimaInputPenjual');
    Route::get('/admin/penjual/hapusPenjual/{id}', [AdminController::class, 'hapusPenjual'])->name('hapusPenjual');
    Route::get('/admin/penjual/editPenjual/{id}', [AdminController::class, 'editPenjual'])->name('editPenjual');
    Route::put('/admin/penjual/updatePenjual', [AdminController::class, 'updatePenjual'])->name('updatePenjual');
    //pembeli
    Route::get('/admin/pembeli', [AdminController::class, 'pembeli'])->name('pembeli');
    Route::delete('/admin/pembeli/hapusPembeli/{id}', [AdminController::class, 'hapusPembeli'])->name('hapusPembeli');
    Route::get('/adminLogout', [AdminController::class, 'destroy'])->name('adminLogout');
    //produk
    Route::get('/admin/produk', [AdminController::class, 'produk'])->name('produk');
    Route::get('/admin/produk/tambahProduk', [AdminController::class, 'tambahProduk'])->name('tambahProduk');
    Route::post('/admin/produk/terimaInputProduk', [AdminController::class, 'terimaInputProduk'])->name('terimaInputProduk');
    Route::delete('/admin/produk/hapusProduk/{id}', [AdminController::class, 'hapusProduk'])->name('hapusProduk');
    Route::get('/admin/produk/editProduk/{id}', [AdminController::class, 'editProduk'])->name('editProduk');
    Route::put('/admin/produk/updateProduk/{id}', [AdminController::class, 'updateProduk'])->name('updateProduk');
});

Route::middleware(['auth', 'role:pembeli'])->group(function () {
    Route::get('/pembeli', [PembeliController::class, 'berandaPembeli'])->name('pembeliBeranda');
    Route::get('/pembeli/produk', [PembeliController::class, 'produk'])->name('produkPembeli');
    Route::get('/pembeli/produk/{id}', [PembeliController::class, 'produkDariKategori'])->name('produkPembeliDariKategori');
    Route::get('/pembeli/detailProduk/{id}', [PembeliController::class, 'detailProduk'])->name('detailProdukPembeli');
    Route::get('/pembeli/keranjang', [PembeliController::class, 'keranjang'])->name('keranjangPembeli');
    Route::post('/pembeli/isiKeranjang', [PembeliController::class, 'isiKeranjang'])->name('isiKeranjangPembeli');
    Route::get('/pembeli/detailPesanan', [PembeliController::class, 'detailPesanan'])->name('detailPesanan');
    Route::get('/pembeli/pesanan/{id}', [PembeliController::class, 'pesanan'])->name('pesanan');
    Route::get('/pembeli/daftarPesanan', [PembeliController::class, 'daftarPesanan'])->name('daftarPesanan');
    Route::post('/pembeli/cekout', [PembeliController::class, 'cekout'])->name('cekout');
    Route::get('/pembeli/permintaanServis', [PembeliController::class, 'permintaanServis'])->name('permintaanServis');
    Route::get('/pembeli/pembeliProfil', [PembeliController::class, 'pembeliProfil'])->name('pembeliProfil');
    Route::post('/pembeli/tambahProfil', [PembeliController::class, 'tambahProfil'])->name('tambahProfil');
    Route::put('/pembeli/editProfil', [PembeliController::class, 'editProfil'])->name('editProfil');
    Route::get('/pembeli/hapusPesanan/{id}', [PembeliController::class, 'hapusPesanan'])->name('hapusPesanan');
    Route::get('/pembeli/batalPesanan/{id}', [PembeliController::class, 'batalPesanan'])->name('batalPesanan');
    Route::get('/pembeli/hapusKeranjang/{id}', [PembeliController::class, 'hapusKeranjang'])->name('hapusKeranjang');
    Route::post('/pembeli/cekOutKeranjang/', [PembeliController::class, 'cekOutKeranjang'])->name('cekOutKeranjang');
    Route::get('/pembeli/cekOutKeranjangPembeli/{id}', [PembeliController::class, 'cekOutKeranjangPembeli'])->name('cekOutKeranjangPembeli');
    Route::get('/pembeli/editUser', [PembeliController::class, 'editUser'])->name('editUser');
    Route::put('/pembeli/updateUser', [PembeliController::class, 'updateUser'])->name('updateUser');
});

Route::middleware(['auth', 'role:penjual'])->group(function () {
    Route::get('/penjual', [PenjualController::class, 'berandaPenjual'])->name('penjualBeranda');
    Route::get('/penjual/produkPenjual', [PenjualController::class, 'penjualProduk'])->name( 'penjualProduk');
    Route::get('/penjual/editProdukPenjual/{id}', [PenjualController::class, 'editProdukPenjual'])->name( 'editProdukPenjual');
    Route::put('/penjual/updateProdukPenjual/{id}', [PenjualController::class, 'updateProdukPenjual'])->name( 'updateProdukPenjual');
    Route::get('/penjual/hapusPenjual/{id}', [PenjualController::class, 'hapusProdukPenjual'])->name( 'hapusProdukPenjual');
    Route::get('/penjual/pesananPenjual', [PenjualController::class, 'pesananPenjual'])->name( 'pesananPenjual');
    Route::put('/pesanan/update-status/{id}', [PenjualController::class, 'updateStatus'])->name('updateStatusPesanan');
    Route::get('/penjual/produk/riwayatTransaksi', [PenjualController::class, 'riwayatTransaksi'])->name('riwayatTransaksi');
});

require __DIR__ . '/auth.php';

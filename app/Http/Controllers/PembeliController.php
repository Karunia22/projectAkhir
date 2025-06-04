<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;

class PembeliController extends Controller
{
    //
    public function berandaPembeli(){
    $kategori = Kategori::all();
        return view('pembeli.beranda', compact('kategori'));
    }

    public function produk(){
    $kategori = Kategori::all();
        return view('pembeli.produk', compact('kategori'));
    }

    public function detailProduk(){
    $kategori = Kategori::all();
        return view('pembeli.detailProduk', compact('kategori'));
    }

    public function keranjang(){
        return view('pembeli.keranjang');
    }

    public function detailPesanan(){
        return view('pembeli.detailPesanan');
    }
    public function pesanan(){
        return view('pembeli.pesanan');
    }

    public function permintaanServis(){
        return view('pembeli.permintaanServis');
    }

    public function pembeliProfil(){
        return view('pembeli.profil');
    }
}

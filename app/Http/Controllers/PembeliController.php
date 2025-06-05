<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Produk;

class PembeliController extends Controller
{
    //
    public function berandaPembeli()
    {
        $produk = Produk::all();
        return view('pembeli.beranda', compact('produk'));
    }

    public function produk()
    {
        $kategori = Kategori::all();
        return view('pembeli.produk', compact('kategori'));
    }

    public function detailProduk($id)
    {
        $produk = Produk::all();
        $id = $id;
        return view('pembeli.detailProduk', compact('produk', 'id'));
    }

    public function keranjang()
    {
        return view('pembeli.keranjang');
    }

    public function detailPesanan()
    {
        return view('pembeli.detailPesanan');
    }
    public function pesanan()
    {
        return view('pembeli.pesanan');
    }

    public function permintaanServis()
    {
        return view('pembeli.permintaanServis');
    }

    public function pembeliProfil()
    {
        return view('pembeli.profil');
    }
}

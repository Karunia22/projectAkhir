<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Models\Produk;
class PenjualController extends Controller
{
    //
    public function berandaPenjual(){
        return view('penjual.berandaPenjual');
    }

    public function penjualProduk(){
        $data = Produk::with('produkKeKategori')->get();
        return view('penjual.penjualProduk', compact('data'));
    }

    public function editProdukPenjual(Request $request, $id){
        $kategori = Kategori::all();
        $data = Produk::find($id);
        return view('penjual.editProduk', compact('data', 'kategori'));
    }


    public function updateProdukPenjual(Request $request, $id)
    {
        $data = Produk::find($id);
        $data->update($request->all());
        $data->save();
        return redirect()->route('penjualProduk');
    }

    public function hapusProdukPenjual(Request $request, $id){
        $data = Produk::find($request->id);
        $data->delete();
        return redirect()->route('penjualProduk');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\DetailPesanan;
use App\Models\Kategori;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use App\Models\Produk;
use Illuminate\Support\Facades\Auth;

class PenjualController extends Controller
{
    //
    public function berandaPenjual()
    {
        return view('penjual.berandaPenjual');
    }

    public function penjualProduk()
    {
        $data = Produk::with('produkKeKategori')->get();
        return view('penjual.penjualProduk', compact('data'));
    }

    public function editProdukPenjual(Request $request, $id)
    {
        // dd($id);
        $data = Produk::find($id);
        return view('penjual.editProduk', compact('data'));
    }

    public function riwayatTransaksi()
    {
        $data = DetailPesanan::with(['detailPesananKeProduk', 'detailPesananKePesanan'])->get();
        return view('penjual.riwayatTransaksi', compact('data'));
    }
    public function updateProdukPenjual(Request $request, $id)
    {
        $data = Produk::find($id);
        $data->update($request->all());
        $data->save();
        return redirect()->route('penjualProduk');
    }

    public function hapusProdukPenjual(Request $request, $id)
    {
        $data = Produk::find($request->id);
        $data->delete();
        return redirect()->route('penjualProduk');
    }

    public function pesananPenjual()
    {
        $pesanan = Pesanan::with([
            'pesananKeUser',
            'pesananKeDetailPesanan.detailPesananKeProduk' // detail + produk
        ])->get();
        return view('penjual.penjualPesanan', compact('pesanan'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,paid,shipped'
        ]);

        $pesanan = Pesanan::findOrFail($id);
        $pesanan->status = $request->status;
        $pesanan->save();

        return redirect()->back()->with('success', 'Status pesanan berhasil diperbarui.');
    }
}

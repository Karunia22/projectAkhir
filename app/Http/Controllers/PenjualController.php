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
        // dd($data->img_url);
        return view('penjual.editProduk', compact('data'))->with('success', 'Produk berhasil diperbarui!');
    }

    public function riwayatTransaksi()
    {
        $data = DetailPesanan::with(['detailPesananKeProduk', 'detailPesananKePesanan'])->get();
        return view('penjual.riwayatTransaksi', compact('data'));
    }
    public function updateProdukPenjual(Request $request, $id)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:100',
            'deskripsi' => 'required|string|max:1000',
            'harga' => 'required|integer|min:0',
            'stok' => 'required|integer|min:0',
            'kategori_id' => 'required|exists:kategori,id',
            'img_url' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'nama_produk.required' => 'Nama wajib.',
            'deskripsi.required' => 'Deskripsi wajib.',
            'harga.required' => 'Harga wajib.',
            'harga.integer' => 'Harga angka.',
            'stok.required' => 'Stok wajib.',
            'stok.integer' => 'Stok angka.',
            'kategori_id.required' => 'Kategori wajib.',
            'kategori_id.exists' => 'Kategori salah.',
            'img_url.image' => 'File harus gambar.',
            'img_url.mimes' => 'Format gambar salah.',
            'img_url.max' => 'Gambar max 2MB.',
        ]);

        $produk = Produk::findOrFail($id);

        // Jika ada gambar baru
        if ($request->hasFile('img_url')) {
            // Hapus gambar lama (jika ada)
            if ($produk->img_url && file_exists(public_path($produk->img_url))) {
                unlink(public_path($produk->img_url));
            }

            // Upload gambar baru
            $gambar = $request->file('img_url');
            $namaGambar = time() . '_' . preg_replace('/\s+/', '_', strtolower($gambar->getClientOriginalName()));
            $gambar->move(public_path('uploads'), $namaGambar);
            $produk->img_url = 'uploads/' . $namaGambar;
        }

        // Update kolom lain
        $produk->nama_produk = $request->nama_produk;
        $produk->deskripsi = $request->deskripsi;
        $produk->harga = $request->harga;
        $produk->stok = $request->stok;
        $produk->kategori_id = $request->kategori_id;
        $produk->save();

        return redirect()->route('penjualProduk')->with('success', 'Produk berhasil diedit.');
    }

    public function hapusProdukPenjual(Request $request, $id)
    {
        $data = Produk::find($request->id);
        $data->delete();
        return redirect()->route('penjualProduk')->with('success', 'Produk berhasil dihapus');
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

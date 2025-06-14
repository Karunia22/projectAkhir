<?php

namespace App\Http\Controllers;

use App\Models\DetailPesanan;
use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Keranjang;
use App\Models\Pesanan;
use App\Models\Produk;
use App\Models\Profil;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        $produk = Produk::all();
        return view('pembeli.produk', compact('kategori', 'produk'));
    }

    public function produkDariKategori(Request $request, $id)
    {
        $kategori = Kategori::all();
        $produk = Produk::where('kategori_id', $id)->get();
        return view('pembeli.produk', compact('kategori', 'produk'));
    }

    public function detailProduk(Request $request, $id)
    {
        $produk = Produk::all();
        $user = Auth::user()->id;
        $id = $id;
        return view('pembeli.detailProduk', compact('produk', 'id', 'user'));
    }

    public function keranjang()
    {
        $keranjang = Keranjang::with('keranjangKeProduk')->get();
        $user = Auth::user()->id;
        return view('pembeli.keranjang', compact('keranjang', 'user'));
    }

    public function isiKeranjang(Request $request)
    {

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'produk_id' => 'required|integer|exists:produk,id',
            'jumlah' => 'required|integer|min:1'
        ]);
        $user = Auth::user()->id;
        $produk = Keranjang::where('user_id', $user)
            ->where('produk_id', $request->produk_id)
            ->first();;

        if ($produk == null) {
            Keranjang::create([
                'user_id' => $request->user_id,
                'produk_id' => $request->produk_id,
                'jumlah' => $request->jumlah
            ]);
        } else if ($produk != null) {
            $produk->jumlah += $request->jumlah;
            $produk->save();
        }

        return redirect()->route('keranjangPembeli')->with('success', 'Berhasil ditambahkan ke keranjang');
    }

    public function pesanan($id)
    {
        // dd($id);

        $pesanan = Pesanan::with('pesananKeDetailPesanan.detailPesananKeProduk')->findOrFail($id);

        return view('pembeli.pesanan', compact('pesanan'));
    }
    public function cekout(Request $request)
    {
        $user = Auth::user();
        $profil = $user->profil;
        // $pembeli = Pesanan::with('')
        $produk = Produk::findOrFail($request->produk_id);


        DB::beginTransaction();
        try {
            $pesanan = Pesanan::create([
                'user_id' => $request->user_id,
                'total_harga' => 0,
                'alamat_pengiriman' => $profil->alamat ?? '',
                'kode_pos' => $profil->kode_pos ?? '',
                'kota' => $profil->kota ?? '',
                'metode_pembayaran' => 'cod',
                'no_telepon' => $profil->no_telepon ?? ''
            ]);

            $detail = DetailPesanan::create([
                'pesanan_id' => $pesanan->id,
                'jumlah' => $request->jumlah,
                'produk_id' => $request->produk_id,
                'total_harga' => $produk->harga * $request->jumlah,
            ]);
            // dd($detail);
            $pesanan->total_harga = $detail->total_harga;
            $pesanan->save();
            DB::commit();
            return redirect()->route('pesanan', ['id' => $detail->id]);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('detailPesanan');
        }
    }

    public function detailPesanan()
    {
        return view('pembeli.detailPesanan');
    }

    public function permintaanServis()
    {
        return view('pembeli.permintaanServis');
    }

    public function pembeliProfil()
    {
        $profil = Profil::with('user')->where('id_user', Auth::user()->id)->first();
        // dd($profil);
        return view('pembeli.profil', compact('profil'));
    }


    public function tambahProfil(Request $table)
    {
        // return view('pembeli.profil');
    }
    public function editProfil(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'id_user' => 'required|exists:profils,id_user',
            'kota' => 'required|string',
            'alamat' => 'required|string',
            'no_telepon' => 'required|string',
            'kode_pos' => 'required|string',
        ]);

        $profil = Profil::where('id_user', $request->id_user)->first();

        // dd($profil);
        $profil->kota = $request->kota;
        $profil->alamat = $request->alamat;
        $profil->no_telepon = $request->no_telepon;
        $profil->kode_pos = $request->kode_pos;
        $profil->save();

        return redirect()->route('pembeliProfil');
    }
}

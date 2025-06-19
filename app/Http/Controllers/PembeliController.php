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
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

class PembeliController extends Controller
{
    //
    public function berandaPembeli()
    {
        $produk = Produk::inRandomOrder()->take(5)->get();
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
        $user = Auth::user()->id;
        $keranjang = Keranjang::with('keranjangKeProduk')->where('user_id', $user)->get();
        return view('pembeli.keranjang', compact('keranjang'));
    }

    public function isiKeranjang(Request $request)
    {

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'produk_id' => 'required|integer|exists:produk,id',
            'jumlah' => 'required|integer|min:1',
        ], [
            'user_id.required' => 'Pengguna tidak boleh kosong.',
            'user_id.exists' => 'Pengguna tidak ditemukan di sistem.',

            'produk_id.required' => 'Produk wajib dipilih.',
            'produk_id.integer' => 'ID produk harus berupa angka.',
            'produk_id.exists' => 'Produk tidak tersedia.',

            'jumlah.required' => 'Jumlah pesanan wajib diisi.',
            'jumlah.integer' => 'Jumlah pesanan harus berupa angka.',
            'jumlah.min' => 'Jumlah pesanan minimal 1.',
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

        $pesanan = Pesanan::with('pesananKeDetailPesanan.detailPesananKeProduk')->find($id);
        // dd($pesanan);
        return view('pembeli.pesanan', compact('pesanan'));
    }
    public function cekout(Request $request)
    {
        $request->validate([
            'produk_id' => 'required|integer|exists:produk,id',
            'jumlah' => 'required|integer|min:1',
            'metode_pembayaran' => [
                'required',
                Rule::in(['COD']),
            ],
        ], [
            'produk.required' => 'Produk tidak ada',
            'jumlah.required' => 'Pesanan tidak boleh Nol',
            'metode_pembayaran.required' => 'Metode pembayaran tidak valid',
        ]);
        $user = Auth::user();
        $profil = $user->profil;
        $produk = Produk::findOrFail($request->produk_id);
        // dd($produk);
        if ($request->jumlah > $produk->stok) {
            return redirect()->back()->withErrors('Stok tidak memenuhi');
        };
        DB::beginTransaction();
        try {
            $pesanan = Pesanan::create([
                'user_id' => Auth::user()->id,
                'total_harga' => 0,
                'alamat_pengiriman' => $profil->alamat ?? '',
                'kode_pos' => $profil->kode_pos ?? '',
                'kota' => $profil->kota ?? '',
                'metode_pembayaran' => $request->metode_pembayaran,
                'no_telepon' => $profil->no_telepon ?? ''
            ]);

            $detail = DetailPesanan::create([
                'pesanan_id' => $pesanan->id,
                'jumlah' => $request->jumlah,
                'produk_id' => $request->produk_id,
                'total_harga' => $produk->harga * $request->jumlah,
            ]);

            $pesanan->total_harga = $detail->total_harga;
            $pesanan->save();
            $produk->stok -= $request->jumlah;
            $produk->save();
            DB::commit();
            return redirect()->route('pesanan', ['id' => $pesanan->id])->with('success', 'Pesanan berhasil dibuat');
            // dd($detail);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors('Gagagl membuat pesanan');
        }
    }

    public function daftarPesanan()
    {
        $pesanan = Pesanan::with('pesananKeDetailPesanan.detailPesananKeProduk')
            ->where('user_id', Auth::user()->id)
            ->get();
        // dd($pesanan);
        return view('pembeli.daftarPesanan', compact('pesanan'));
    }

    public function batalPesanan($id)
    {
        $pesanan = Pesanan::findOrFail($id);

        foreach ($pesanan->pesananKeDetailPesanan as $detail) {
            $produk = $detail->detailPesananKeProduk;
            $produk->stok += $detail->jumlah;
            $produk->save();

            $detail->delete();
        }

        $pesanan->delete();

        Pesanan::destroy($id);
        return redirect()->back()->with('success', 'Pesanan dihapus dan stok produk dikembalikan.');
    }

    public function hapusKeranjang($id)
    {
        Keranjang::destroy($id);
        return redirect()->back();
    }

    public function hapusPesanan($id)
    {
        Pesanan::destroy($id);
        return redirect()->back();
    }

    public function pembeliProfil()
    {
        $profil = Profil::with('user')->where('id_user', Auth::user()->id)->first();
        // dd($profil);
        return view('pembeli.profil', compact('profil'));
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

        return redirect()->route('pembeliProfil')->with('success', 'Profil berhasil diubah');
    }

    public function cekOutKeranjang(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'indexKeranjang' => 'required|array|min:1',
            'indexKeranjang.*' => 'integer|exists:keranjang,id',
            'metode_pembayaran' => [
                'required',
                Rule::in(['COD']),
            ],
        ], [
            'indexKeranjang.required' => 'Pilih minimal satu item keranjang.',
            'indexKeranjang.array' => 'Data keranjang tidak valid.',
            'indexKeranjang.min' => 'Minimal satu item keranjang harus dipilih.',
            'indexKeranjang.*.integer' => 'Data keranjang harus berupa angka.',
            'indexKeranjang.*.exists' => 'Beberapa item keranjang tidak ditemukan.',
            'metode_pembayaran.required' => 'Metode pembayaran tidak valid',
        ]);
        $idKeranjang = $request->input('indexKeranjang');
        // dd($idKeranjang);
        $user = Auth::user()->id;
        $keranjangItems = Keranjang::with(['keranjangKeProduk', 'keranjangKeUser.profil'])->whereIn('id', $idKeranjang)->get();

        if ($keranjangItems->isEmpty()) {
            return redirect()->back()->withErrors('Tidak ada item yang dipilih');
        }
        DB::beginTransaction();
        try {
            // Ambil data user dan alamat dari salah satu item keranjang
            $profil = $keranjangItems[0]->keranjangKeUser->profil;

            $pesanan = Pesanan::create([
                'user_id' => $user,
                'alamat_pengiriman' => $profil->alamat,
                'kode_pos' => $profil->kode_pos,
                'kota' => $profil->kota,
                'metode_pembayaran' => $request->metode_pembayaran,
                'no_telepon' => $profil->no_telepon,
                'total_harga' => 0,
            ]);

            $totalHarga = 0;

            foreach ($keranjangItems as $item) {
                $produk = $item->keranjangKeProduk;

                if ($item->jumlah > $produk->stok) {
                    DB::rollBack();
                    return redirect()->back()->withErrors("Jumlah produk '{$produk->nama_produk}' melebihi stok.");
                }

                DetailPesanan::create([
                    'produk_id' => $produk->id,
                    'pesanan_id' => $pesanan->id,
                    'jumlah' => $item->jumlah,
                    'total_harga' => $produk->harga * $item->jumlah,
                ]);

                $totalHarga += $produk->harga * $item->jumlah;

                $produk->stok -= $item->jumlah;
                $produk->save();

                $item->delete();
            }


            $pesanan->total_harga = $totalHarga;
            $pesanan->save();
            DB::commit();
            return redirect()->route('cekOutKeranjangPembeli', ['id' =>  $pesanan->id])->with('success',  'Pesanan berhasil di buat');
        } catch (\Exception $te) {
            DB::rollBack();
            return redirect()->back()->withErrors('Batal membuat pesanan');
        }
    }

    public function cekOutKeranjangPembeli($id)
    {
        $pesanan = Pesanan::with([
            'pesananKeDetailPesanan.detailPesananKeProduk',
            'pesananKeUser.profil'
        ])->findOrFail($id);
        return view('pembeli.CeckOut', compact('pesanan'))->with('success','Pesanan berhasil dibuat');
    }

    public function editUser()
    {
        $user = User::find(Auth::user()->id);
        return view('pembeli.editUser', compact('user'));
    }

    public function updateUser(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'no_telepon' => 'required|string|max:15',
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
            'password' => 'required',
        ], [
            'name.required' => 'Nama wajib diisi.',
            'no_telepon.required' => 'Nomor telepon wajib diisi.',
            'password.required' => 'password wajib diisi.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        $user = User::find(Auth::user()->id);
        $user->name = $request->name;
        $user->no_telepon = $request->no_telepon;
        $user->password = Hash::make($request->password); // FIXED!
        $user->save();

        return redirect()->route('pembeliProfil')->with('success', 'Data berhasil disimpan');
    }
}

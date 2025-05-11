<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\User;
use App\Models\Produk;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{

    public function berandaAdmin()
    {
        $user = Auth::user()->name;
        return view('admin.tampilanAdmin', compact('user'));
    }

    public function kategori()
    {
        $data = Kategori::all();
        return view('admin.kategoriBarang', compact('data'));
    }

    public function tambahKategori()
    {
        return view('admin.tambahKategoriBarang');
    }

    public function terimaInputKategori(Request $request)
    {
        Kategori::create($request->all());
        return redirect()->route('kategori');
    }

    public function hapusKategori(Request $request)
    {
        $data = Kategori::find($request->id);
        $data->delete();
        return redirect()->route('kategori');
    }
    public function editKategori(Request $request, $id)
    {
        $data = Kategori::find($id);
        return view('admin.editKategori', compact('data'));
    }

    public function updateKategori(Request $request, $id)
    {
        $data = Kategori::find($id);
        $data->update($request->all());
        $data->save();
        return redirect()->route('kategori');
    }

    public function penjual()
    {
        $data = User::all();
        return view('admin.penjual', compact('data'));
    }

    public function tambahPenjual()
    {
        return view('admin.tambahPenjual');
    }

    public function terimaInputPenjual(Request $request)
    {
        User::create($request->all());
        return redirect()->route('penjual');
    }

    public function hapusPenjual(Request $request)
    {
        $data = User::find($request->id);
        $data->delete();
        return redirect()->route('penjual');
    }
    public function editPenjual(Request $request, $id)
    {
        $data = User::find($id);
        return view('admin.editPenjual', compact('data'));
    }

    public function updatePenjual(Request $request, $id)
    {
        $data = User::find($id);
        $data->update($request->all());
        $data->save();
        return redirect()->route('penjual');
    }

    public function pembeli()
    {
        $data = User::all();
        return view('admin.pembeli', compact('data'));
    }

    public function hapusPembeli(Request $request)
    {
        $data = User::find($request->id);
        $data->delete();
        return redirect()->route('pembeli');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('login');
    }

    public function produk()
    {
        $data = Produk::with('produkKeKategori')->get();
        return view('admin.produk', compact('data'));
    }

    public function tambahProduk()
    {
        $data = Kategori::all();
        return view('admin.tambahProduk', compact('data'));
    }

    public function terimaInputProduk(Request $request)
    {
    $request->validate([
        'nama_produk' => 'required',
        'deskripsi' => 'required',
        'harga' => 'required|numeric',
        'stok' => 'required|numeric',
        'kategori_id' => 'required|exists:kategori,id',
        'img_url' => 'required|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $gambar = $request->file('img_url');
    $namaGambar = time() . '_' . $gambar->getClientOriginalName();
    $gambar->move(public_path('uploads'), $namaGambar);

    // Simpan ke database
    Produk::create([
        'nama_produk' => $request->nama_produk,
        'deskripsi' => $request->deskripsi,
        'harga' => $request->harga,
        'stok' => $request->stok,
        'kategori_id' => $request->kategori_id,
        'img_url' => 'uploads/' . $namaGambar
    ]);

    return redirect()->route('produk')->with('success', 'Produk berhasil disimpan!');
    }

    public function hapusProduk(Request $request)
    {
        $data = Produk::find($request->id);
        $data->delete();
        return redirect()->route('produk');
    }
    
    public function editProduk(Request $request, $id)
    {
        $kategori = Kategori::all();
        $data = Produk::find($id);
        return view('admin.editProduk', compact('data','kategori'));
    }

    public function updateProduk(Request $request, $id)
    {
        $data = Produk::find($id);
        $data->update($request->all());
        $data->save();
        return redirect()->route('produk');
    }
}
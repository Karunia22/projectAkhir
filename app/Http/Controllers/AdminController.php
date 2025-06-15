<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\User;
use App\Models\Produk;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
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
        $validated = $request->validate([
            'kategori_produk' => 'required|string|max:255',
        ], [
            'kategori_produk.required' => 'Kategori tidak boleh kosong.',
            'kategori_produk.unique' => 'Kategori sudah ada.',
        ]);

        Kategori::create($validated);
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
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'no_telepon' => 'required|regex:/^08[0-9]{8,11}$/',
        ], [
            'name.required' => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 8 karakter.',
            'no_telepon.required' => 'Nomor HP wajib diisi.',
            'no_telepon.regex' => 'Format nomor HP tidak valid. Gunakan format 08xxxxxxxxxx.',
        ]);
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
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'no_telepon' => 'required|regex:/^08[0-9]{8,11}$/',
        ], [
            'name.required' => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 8 karakter.',
            'no_telepon.required' => 'Nomor HP wajib diisi.',
            'no_telepon.regex' => 'Format nomor HP tidak valid. Gunakan format 08xxxxxxxxxx.',
        ]);
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
            'nama_produk' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'kategori_id' => 'required|exists:kategori,id',
            'img_url' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Upload gambar
        $gambar = $request->file('img_url');
        $namaGambar = time() . '_' . preg_replace('/\s+/', '_', strtolower($gambar->getClientOriginalName()));
        $gambar->move(public_path('uploads'), $namaGambar);

        // Simpan ke database
        Produk::create([
            'nama_produk' => $request->nama_produk,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'kategori_id' => $request->kategori_id,
            'img_url' => 'uploads/' . $namaGambar,
        ]);

        return redirect()->route('produk')->with('success', 'Produk berhasil disimpan!');
    }

    public function hapusProduk(Request $request)
    {
        $data = Produk::find($request->id);
        if ($data->img_url && File::exists(public_path($data->img_url))) {
            File::delete(public_path($data->img_url));
        }
        $data->delete();
        return redirect()->route('produk');
    }

    public function editProduk(Request $request, $id)
    {
        $kategori = Kategori::all();
        $data = Produk::find($id);
        return view('admin.editProduk', compact('data', 'kategori'));
    }

    public function updateProduk(Request $request, $id)
    {
        $data = Produk::find($id);
        $data->update($request->all());
        $data->save();
        return redirect()->route('produk');
    }
}

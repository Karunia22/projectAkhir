<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Kategori;
use App\Models\Keranjang;
use App\Models\DetailPesanan;
class Produk extends Model
{
    //
    protected $table = "produk";
    protected $fillable = ['nama_produk','deskripsi','harga','stok','kategori_id','img_url'];

    public function produkKeKategori(){
        return $this->belongsTo(Kategori::class,'kategori_id','id');
    }
    public function produkKeKeranjang(){
        return $this->hasMany(Keranjang::class,'kategori_id','id');
    }
    public function produkKeKeDetailPesanan(){
        return $this->hasMany(DetailPesanan::class,'kategori_id','id');
    }

}
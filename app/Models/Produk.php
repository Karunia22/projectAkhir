<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Kategori;
class Produk extends Model
{
    //
    protected $table = "produk";
    protected $fillable = ['nama_produk','deskripsi','harga','stok','kategori_id','img_url'];

    public function produkKeKategori(){
        return $this->belongsTo(Kategori::class,'kategori_id','id');
    }
}
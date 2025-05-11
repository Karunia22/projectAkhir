<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Produk;

class Kategori extends Model
{
    //
    protected $table = 'kategori';
    protected $fillable = ['kategori_produk'];

    public function kategoriKeProduk(){
        return $this->hasMany(Produk::class,'kategori_id','id');
    }
}

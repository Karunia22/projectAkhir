<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Produk;
class Keranjang extends Model
{
    //
    protected $table = 'keranjang';
    protected $fillable = ['user_id','produk_id','jumlah'];

    public function keranjangKeUser(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function keranjangKeProduk(){
        return $this->belongsTo(Produk::class, 'produk_id', 'id');
    }
}
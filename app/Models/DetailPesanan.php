<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Pesanan;
use App\Models\Produk;
class DetailPesanan extends Model
{
    //
    protected $table = 'detail_pesanan';
    protected $fillable = [
        'pesanan_id',
        'produk_id',
        'jumlah',
        'total_harga'
    ];

    public function detailPesananKePesanan(){
        return $this->belongsTo(Pesanan::class, 'pesanan_id','id');
    }
    public function detailPesananKeProduk(){
        return $this->belongsTo(Produk::class, 'produk_id','id');
    }
}

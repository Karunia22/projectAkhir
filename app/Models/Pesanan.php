<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\DetailPesanan;

class Pesanan extends Model
{
    //
    protected $table = 'pesanan';
    protected $fillable = [
        'user_id',
        'total_harga',
        'status',
        'alamat_pengiriman',
        'kota','kode_pos',
        'no_telepon',
        'metode_pembayaran'
    ];

    public function pesananKeUser(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function pesananKeDetailPesanan(){
        return $this->belongsTo(DetailPesanan::class, 'pesanan_id', 'id');
    }
}

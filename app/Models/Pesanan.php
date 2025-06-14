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
        'kota',
        'kode_pos',
        'no_telepon',
        'metode_pembayaran'
    ];

    public function pesananKeUser()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    
    public function pesananKeDetailPesanan()
    {
        return $this->hasMany(DetailPesanan::class, 'pesanan_id', 'id');
    }


    public function produk()
    {
        return $this->belongsToMany(Produk::class, 'detail_pesanan', 'pesanan_id', 'produk_id')
            ->withPivot('jumlah', 'total_harga')
            ->withTimestamps();
    }
}

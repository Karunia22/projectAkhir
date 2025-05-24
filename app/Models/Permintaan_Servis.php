<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Produk;
use App\Models\User;
use App\Models\Layanan_Servis;
use App\Models\Penugasan_teknisi;

class Permintaan_Servis extends Model
{
    //
    protected $table = 'permintaan_servis';
    protected $fillable = [
        'user_id',
        'layanan_id',
        'alamat',
        'jadwal',
        'status',
        'no_telepon'
    ];

    public function permintaan_servisKeProduk(){
        return $this->belongsTo(Produk::class, 'user_id', 'id');
    }
    
    public function permintaan_servisKeUser(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function permintaan_servisKeLayanan_Servis(){
        return $this->belongsTo(Layanan_Servis::class, 'layanan_id', 'id');
    }

    public function permintaan_servisKePenugasan_Teknisi(){
        return $this->belongsTo(Penugasan_teknisi::class, 'permintaan_id', 'id');
    }
}

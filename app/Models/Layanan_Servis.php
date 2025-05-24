<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Permintaan_Servis;

class Layanan_Servis extends Model
{
    //
    protected $table = 'layanan_servis';
    protected $fillable = [
        'nama',
        'deskripsi',
        'harga',
    ];

    public function layanan_ServisKePermintaan_Servis(){
        return $this->hasMany(Permintaan_Servis::class, 'layanan_id', 'id');
    }
}

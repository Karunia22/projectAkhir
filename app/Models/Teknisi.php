<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Penugasan_teknisi;

class Teknisi extends Model
{
    //
    protected $table = 'teknisi';
    protected $fillable = [
        'nama',
        'nama'
    ];

    public function teknisiKePenugasan_teknisi(){
        return $this->hasMany(Penugasan_teknisi::class, 'teknisi_id', 'id');
    }
}

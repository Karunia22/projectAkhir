<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Teknisi;
use App\Models\Permintaan_Servis;

class Penugasan_teknisi extends Model
{
    //
    protected $table = 'penugasan_teknisi';
    protected $fillable = [
        'teknisi_id',
        'permintaan_id'
    ];

    public function penugasan_teknisiKeTeknisi(){
        return $this->belongsTo(Teknisi::class, 'teknisi_id', 'id');
    }
    
    public function penugasan_teknisiKePermintaan_servis(){
        return $this->belongsTo(Permintaan_Servis::class, 'permintaan_id', 'id');
    }


}

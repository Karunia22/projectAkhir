<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profil extends Model
{
    //
    protected $table = 'profils'; // Nama tabel

    protected $fillable = [
        'id_user',
        'kota',
        'alamat',
        'kode_pos',
        'no_telepon',
    ];

    // Relasi ke tabel users
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}

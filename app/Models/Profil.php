<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profil extends Model
{
    //
    protected $table = 'profils';
    protected $fillable = ['id_user'];

    public function profilsKeUsers(){
        return $this->belongsTo(User::class);
    }
}

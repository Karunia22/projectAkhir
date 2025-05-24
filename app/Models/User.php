<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Pesanan;
use App\Models\Keranjang;
use App\Models\Permintaan_Servis;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function userKePesanan(){
        return $this->hasMany(Pesanan::class, 'user_id',  'id');
    }

    public function userKeKeranjang(){
        return $this->hasMany(Keranjang::class, 'user_id', 'id');
    }

    public function userKePermintaan_Servis(){
        return $this->hasMany(Permintaan_Servis::class, 'user_id', 'id');
    }
}

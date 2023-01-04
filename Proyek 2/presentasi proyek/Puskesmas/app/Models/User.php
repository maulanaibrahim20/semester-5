<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\Akun\Role;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [''];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getAkses()
    {
        // Model Tujuan, ID Untuk Relasi, ID Tujuan
        return $this->belongsTo("App\Models\Akun\Role", "role_id", "id");
    }

    public function getKepalaKecamatan()
    {
        return $this->belongsTo("App\Models\Akun\KepalaKecamatan", "id", "user_id")->withDefault(["nik" => "-", "nomor_hp" => "-"]);
    }

    public function getKelurahan()
    {
        return $this->belongsTo("App\Models\Akun\Kelurahan", "id", "user_id");
    }

    public function getKepalaPuskesmas()
    {
        return $this->belongsTo("App\Models\Akun\KepalaPuskesmas", "id", "user_id");
    }

    public function getBidan()
    {
        return $this->belongsTo("App\Models\Akun\Bidan", "id", "user_id");
    }
}

<?php

namespace App\Models\Perawatan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keluhan extends Model
{
    use HasFactory;

    protected $table = "keluhan";

    protected $guarded = [''];

    public function getPasien()
    {
        return $this->belongsTo("App\Models\Akun\Pasien", "kode_pasien", "kode_pasien");
    }
}

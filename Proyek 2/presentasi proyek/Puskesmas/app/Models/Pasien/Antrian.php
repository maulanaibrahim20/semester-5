<?php

namespace App\Models\Pasien;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Antrian extends Model
{
    use HasFactory;

    protected $table = "antrian_pasien";

    protected $guarded = [''];

    public $primaryKey = "id_antrian";

    protected $keyType = 'string';

    public $incrementing = false;

    public $timestamps = false;
}

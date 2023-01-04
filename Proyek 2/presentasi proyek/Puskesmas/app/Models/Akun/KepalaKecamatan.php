<?php

namespace App\Models\Akun;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KepalaKecamatan extends Model
{
    use HasFactory;

    protected $table = "kepala_kecamatan";

    protected $guarded = [''];

    public $primaryKey = "id_kepala_kecamatan";

    protected $keyType = 'string';

    public $incrementing = false;

    public $timestamps = false;

    public function getUser()
    {
        return $this->belongsTo("App\Models\User", "user_id", "id");
    }
}

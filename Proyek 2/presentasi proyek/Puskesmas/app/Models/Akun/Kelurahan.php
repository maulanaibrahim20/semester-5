<?php

namespace App\Models\Akun;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelurahan extends Model
{
    use HasFactory;

    protected $table = "kelurahan";

    protected $guarded = [''];

    public $primaryKey = "id_kelurahan";

    protected $keyType = 'string';

    public $incrementing = false;

    public $timestamps = false;

    public function getUser()
    {
        return $this->belongsTo("App\Models\User", "user_id", "id");
    }
}

<?php

namespace App\Models\Akun;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KepalaPuskesmas extends Model
{
    use HasFactory;

    protected $table = "kepala_puskesmas";

    protected $guarded = [''];

    public $primaryKey = "id_kepala_puskesmas";

    protected $keyType = 'string';

    public $incrementing = false;

    public function getUser()
    {
        return $this->belongsTo("App\Models\User", "user_id", "id");
    }
}

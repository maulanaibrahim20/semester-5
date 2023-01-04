<?php

namespace App\Models\Akun;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bidan extends Model
{
    use HasFactory;

    protected $table = "bidan";

    protected $guarded = [''];

    public function getBidan()
    {
        return $this->belongsTo("App\Models\User", "user_id", "id");
    }
}

<?php

namespace App\Models\Perawatan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailKeluhan extends Model
{
    use HasFactory;

    protected $table = "detail_keluhan";

    protected $guarded = [''];
}

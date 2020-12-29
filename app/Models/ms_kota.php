<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ms_kota extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "ms_kota";
    protected $guarded = ["id"];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ms_provinsi extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "ms_provinsi";
    protected $guarded = ["id"];
}

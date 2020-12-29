<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class master_ktp extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "master_ktps";
    protected $guarded = ["id"];

    public function provinsi_r(){
        return $this->belongsTo('App\Models\ms_provinsi','prov');
    }

    public function kota_r(){
        return $this->belongsTo('App\Models\ms_kota','kab_kota');
    }
}

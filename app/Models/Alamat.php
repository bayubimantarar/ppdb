<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alamat extends Model
{
    protected $table = 'alamat';
    protected $fillable = [
        'calon_peserta_didik_id',
        'provinsi',
        'kabupaten_kota',
        'kecamatan',
        'kode_pos',
        'alamat',
        'latitude',
        'longitude'
    ];
}

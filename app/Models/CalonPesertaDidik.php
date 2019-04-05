<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CalonPesertaDidik extends Model
{
    protected $table = 'calon_peserta_didik';
    protected $fillable = [
        'nisn',
        'alamat',
        'latitude',
        'longitude',
        'nilai_nhun',
        'skor_jarak',
        'skor_total'
    ];
}

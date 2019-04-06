<?php

namespace App\Models;

use App\Models\Alamat;
use Illuminate\Database\Eloquent\Model;

class CalonPesertaDidik extends Model
{
    protected $table = 'calon_peserta_didik';
    protected $fillable = [
        'nisn',
        'latitude',
        'longitude',
        'nilai_nhun',
        'skor_jarak',
        'skor_total'
    ];

    public function alamat()
    {
        $alamat = $this->hasOne(Alamat::class);

        return $alamat;
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profilemhs extends Model
{
    protected $table = 'profilemhs';

protected $fillable = [
    'npm',
    'kode_prodi',
    'nama_lengkap',
    'nomor_wa',
    'email_kampus',
    'alamat',
    'angkatan',
    'foto_profil'
];

    public $timestamps = false;
}
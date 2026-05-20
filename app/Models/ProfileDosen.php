<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfileDosen extends Model
{
    protected $table = 'profiledosen';

protected $fillable = [
    'nip',
    'nama_lengkap',
    'nomor_wa',
    'email_kampus',
    'alamat',
    'kode_prodi',
    'foto_profil'
];

    public $timestamps = false;
}
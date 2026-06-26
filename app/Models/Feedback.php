<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $table = 'feedback';

    protected $fillable = [
        'npm',
        'kode_prodi',
        'kategori',
        'nip',
        'rating',
        'isi',
        'tanggal'
    ];

    public $timestamps = false;
}
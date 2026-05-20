<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Krs extends Model
{
    protected $table = 'krs';

    protected $fillable = [
        'npm',
        'kode_matkul',
        'status',
        'nip'
    ];

    public $timestamps = false;
}
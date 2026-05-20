<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    protected $table = 'prodi'; // nama tabel di database

    protected $primaryKey = 'kode_prodi'; // karena bukan id

    public $incrementing = false; // karena kode_prodi bukan auto increment

    protected $keyType = 'string'; // kalau kode_prodi varchar (kalau int hapus ini)

    protected $fillable = [
        'kode_prodi',
        'nama_prodi'
    ];
}
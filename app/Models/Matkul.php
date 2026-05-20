<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Matkul extends Model
{
    protected $table = 'matkul';

    protected $fillable = [
        'kode_matkul',
        'nama_matkul',
        'kelas',
        'hari',
        'jam_mulai',
        'jam_selesai',
        'sks',
        'jenis',
        'kode_prodi',
        'kapasitas',
    ];

    public $timestamps = false;

    public function krs()
{
    return $this->hasMany(Krs::class, 'kode_matkul', 'kode_matkul');
}
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class nilai extends Model
{
    use HasFactory;
    protected $table = 'nilai';

    // Kolom yang dapat diisi (fillable)
    protected $fillable = [
        'id_mapel',
        'id_murid',
        'kehadiran',
        'perilaku',
        'tugas',
        'praktek',
        'uts',
        'uas',
        'akhir',
    ];
}

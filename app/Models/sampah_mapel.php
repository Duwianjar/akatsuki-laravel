<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sampah_mapel extends Model
{
    use HasFactory;
    protected $table = 'sampah_mapel';

    // Kolom yang dapat diisi (fillable)
    protected $fillable = [
        'id_mapel',
        'namamapel',
        'id_guru',
        'id_kelas',
        'deskripsi',
        'id_penghapus',
        // Tambahkan kolom lain sesuai dengan struktur tabel Anda
    ];
}
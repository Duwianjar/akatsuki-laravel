<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sampah_users extends Model
{
    use HasFactory;
    protected $table = 'sampah_users';

    // Kolom yang dapat diisi (fillable)
    protected $fillable = [
        'id_users',
        'name',
        'fullname',
        'telepon',
        'email',
        'password',
        'created_at',
        'updated_at',
        'google_id',
        'role',
        'id_penghapus',
        'id_kelas',
        // Tambahkan kolom lain sesuai dengan struktur tabel Anda
    ];
}
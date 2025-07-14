<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $table = 'laporan';

    protected $fillable = [
        'admin_id',
        'judul',
        'isi',
        'tanggal',
        'status',
    ];

    // Relasi ke User/Admin
    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}

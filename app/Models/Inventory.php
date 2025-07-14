<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    // Nama tabel di database (opsional jika sesuai konvensi Laravel)
    protected $table = 'inventories'; // pastikan nama ini sesuai dengan tabel di database kamu

    // Kolom yang bisa diisi secara massal
    protected $fillable = [
        'receive_date',
        'location',
        'plt_id',
        'material',
        'material_description',
        'uom',
        'unrestricted',
        'blocked',
        'remarks',
    ];

    // (Opsional) Jika kamu ingin mengubah format tanggal otomatis
    protected $casts = [
        'receive_date' => 'date',
    ];
}

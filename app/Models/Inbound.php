<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inbound extends Model
{
    use HasFactory;

    protected $table = 'inbounds'; // pastikan nama tabel sesuai

    protected $fillable = [
        'receive_date',
        'no_document',
        'consignee',
        'material',
        'material_description',
        'inbound_qty',
        'uom',
        'plt_id',
        'location',
    ];
}

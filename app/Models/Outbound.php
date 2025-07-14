<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outbound extends Model
{
    use HasFactory;

    protected $table = 'outbounds';

    protected $fillable = [
        'shipped_date',
        'no_document',
        'shipper',
        'plt_id',
        'location',
        'material',
        'material_description',
        'inbound_qty',
        'uom',
        'remarks',
    ];

    protected $casts = [
        'shipped_date' => 'date',
    ];
}

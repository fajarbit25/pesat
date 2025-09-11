<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EggTransTemp extends Model
{
    use HasFactory;
    protected $fillable = [
        'trx_id',
        'egg_id',
        'qty',
        'price',
        'total',
        'status',
        'created_at',
        'cashier_id',
        'tipe_trx_temp',
        'in_out',
    ];
}

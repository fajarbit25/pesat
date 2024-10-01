<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EggTrx extends Model
{
    use HasFactory;
    protected $fillable = [
        'idtransaksi',
        'user_id',
        'costumer_id',
        'tipetrx',
        'payment_status',
        'trxtipe',
        'totalprice',
        'disc',
    ];
}

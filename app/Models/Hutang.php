<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hutang extends Model
{
    use HasFactory;
    protected $fillable = [
        'tanggal',
        'due_date',
        'supplier',
        'user_id',
        'idtrx',
        'status',
        'jumlah',
    ];
}

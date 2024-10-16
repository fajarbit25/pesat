<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReporManual extends Model
{
    use HasFactory;
    protected $fillable = [
        'tanggal',
       'jemputan',
       'stokawal',
       'tjalan',
       'stockakhir',
        'catatan',
       'user_id',
    ];
}

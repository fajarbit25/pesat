<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EggMutasi extends Model
{
    use HasFactory;
    protected $fillable = ['egg_id', 'supplier_id', 'qty', 'date', 'user_id', 'stockawal', 'atockakhir'];

}

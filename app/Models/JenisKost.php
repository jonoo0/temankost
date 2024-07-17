<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisKost extends Model
{
    use HasFactory;
    protected $table = 'jenis_kost';
    protected $guarded = [];
    protected $fillable = [
        'jenis',
       
    ];
}

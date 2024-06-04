<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penghuni extends Model
{
    use HasFactory;
    protected $table = 'penghuni';
    protected $guarded = [];
    protected $fillable = [
        'user_id',
        'no_tlp',
        'alamat',
       
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}

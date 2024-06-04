<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;
    protected $table = 'pesanan';
    protected $guarded = [];

    protected $fillable = [
        'id_penghuni',
        'id_kost',
        'kode_trx',
        'tgl_mulai',
        'tgl_selesai',       
        'jml_bulan',       
        'nominal',       
        'status',       
        'via_bayar',       
        'snap_token',       
        'bukti_bayar',       
    ];

    public function kost(){
        return $this->belongsTo(Kost::class, 'id_kost');
    }
    public function jenis(){
        return $this->belongsTo(JenisKost::class, 'jenis_kost_id');
    }

}

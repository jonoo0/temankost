<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kost extends Model
{
    use HasFactory;
    protected $table = 'kost';
    protected $guarded = [];

    protected $fillable = [
        'id_pemilik',
        'jenis_kost_id',
        'nama_kost',
        'jumlah_kamar',
        'fasilitas_kost',
        'keterangan',
        'luas',
        'lokasi',
        'lat',
        'long',
        'alamat',
        'tarif_perbulan',
    ];

    public function gambar(){
        return $this->hasMany(Gambar::class, 'id_kost');
    }
    public function jenis(){
        return $this->belongsTo(JenisKost::class, 'jenis_kost_id');
    }

    public function pesanan(){
        return $this->hasMany(Pesanan::class, 'id_kost')->orderBy('tgl_selesai','ASC');
    }

    public function pemilik(){
        return $this->belongsTo(Pemilik::class, 'id_pemilik');
    }

    public function scopeDistance($query, $latitude, $longitude, $distance, $unit = "km")
{
    $constant = $unit == "km" ? 6371 : 3959;
    $haversine = "(
        $constant * acos(
            cos(radians(" .$latitude. "))
            * cos(radians(`lat`))
            * cos(radians(`long`) - radians(" .$longitude. "))
            + sin(radians(" .$latitude. ")) * sin(radians(`lat`))
        )
    )";

    return $query->selectRaw("$haversine AS distance")
        ->having("distance", "<=", $distance);
}
}

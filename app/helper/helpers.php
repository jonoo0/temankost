<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;


/*
fungsi tgl digunakan untuk mengubah format tanggal menjadi format tanggal yang lebih panjang
*/
function tgl($date){
    return \Carbon\Carbon::parse($date)->isoFormat('D MMMM Y');
}

/*
fungsi tgls digunakan untuk mengubah format tanggal menjadi format tanggal yang lebih singkat
*/
function tgls($date){
    return \Carbon\Carbon::parse($date)->isoFormat('D MMM Y');
}


/*
fungsi usr digunakan untuk mengambil id user yang sedang login
*/
function usr(){
    return Auth::user()->id;
}


/*
fungsi uriaktif digunakan untuk me set status aktif pada item menu navigasi dari halaman yang sedang diakses user
*/
function uriaktif($uri=''){
    if(is_array($uri)) return in_array(Request::segment(1), $uri) ? 'active' : '';
    return Request::segment(1)== $uri ? 'active' : '';
}

/*
fungsi convetNoTelp digunakan untuk mengkonversi nomor telepon yang diinputkan oleh user
mengubah karakter 0 pada awal nomor telepon menjadi +62
*/
function convertNoTelp($noTelp) {
    $kodeNegara = "+62";
    if (substr($noTelp, 0, 1) === "0") {
        $hasilConvert = $kodeNegara . substr($noTelp, 1);
    } else {
        $hasilConvert = $noTelp;
    }
    return $hasilConvert;
}

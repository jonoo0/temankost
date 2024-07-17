<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kost;
use App\Models\JenisKost;
use App\Models\Pemilik;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    function kost(Request $req)
    {

        $id_jenis = $req->jenis;
        $jenis = JenisKost::all();

        if ($id_jenis) {
            $data = Kost::where('jenis_kost_id', $id_jenis)
                // ->where('jumlah_kamar','>', 0)
                ->paginate(5);
        } else {
            $data = Kost::orderBy('id', 'asc')
                ->paginate(5);
        }

        return view('customer.kost.index', compact('data', 'jenis'));
    }
    function show($id)
    {

        $data =  Kost::find($id);
        $pemilik = User::findOrfail($data->id_pemilik);
        $dekat = '';
        foreach ($data->pesanan->take(1) as $val) {
            $dekat = $val->tgl_selesai;
        }

        $geocoder = new \OpenCage\Geocoder\Geocoder(env('GEOCODE_CLIENT_KEY'));
        $result = $geocoder->geocode($data->lokasi);
        $final_lokasi = $result['results'][0]['formatted'];

        // dd($final_lokasi);
        // dd($dekat);
        // dd($data->lokasi);

        return view('customer.kost.detail', compact('data', 'dekat', 'pemilik', 'final_lokasi'));
    }
}

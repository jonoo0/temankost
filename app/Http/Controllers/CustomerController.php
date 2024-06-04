<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kost;
use App\Models\JenisKost;
use App\Models\Pemilik;
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

        $data =  Kost::join('pemilik as b', 'b.id', 'kost.id_pemilik')
            ->join('users as c', 'c.id', 'b.user_id')
            ->select('kost.*', 'b.no_tlp', 'c.email')
            ->where('kost.id', $id)
            ->with('pesanan')
            ->first();


        $pemilik = Pemilik::findOrfail($data->id_pemilik);
        $dekat = '';
        foreach ($data->pesanan->take(1) as $val) {
            $dekat = $val->tgl_selesai;
        }

        // dd($dekat);

        return view('customer.kost.detail', compact('data', 'dekat', 'pemilik'));
    }
}

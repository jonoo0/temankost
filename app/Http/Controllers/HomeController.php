<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\JenisKost;
use App\Models\Kategori;
use App\Models\Penjualan;
use App\Models\Kost;
use Illuminate\Http\Request;
use App\Models\Pemilik;
use App\Models\Penghuni;
use App\Models\Pesanan;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Console\Input\Input;


class HomeController extends Controller
{

    public function index()
    {
        $kost = Kost::select('kost.*');
        if (Auth::check() == true) {
            if (Auth::user()->role == 'Admin' || Auth::user()->role == 'Pemilik' || Auth::user()->role == 'Penghuni') {
                if (Auth::user()->role == 'Pemilik') {
                    $id_pemilik = Pemilik::where('user_id', Auth::user()->id)->first();
                    // dd($id_pemilik);
                    $id_penghuni = Penghuni::where('user_id', Auth::user()->id)->first();
                    $pesanan = Pesanan::join('kost as a', 'a.id', 'pesanan.id_kost')
                        ->select(
                            'pesanan.*',
                            'a.nama_kost',
                            'a.id_pemilik',
                            'c.no_tlp',
                            'd.email',
                            'd.name as nama_penghuni'
                        )
                        ->join('penghuni as c', 'c.id', 'pesanan.id_penghuni')
                        ->join('users as d', 'd.id', 'c.user_id')
                        ->where('id_pemilik', $id_pemilik->id)->orderBy('pesanan.id', 'desc');
                        // dd($pesanan);

                        $trx = $pesanan->get();
                        // dd($trx);

                    $konf = $pesanan->where('a.id_pemilik', $id_pemilik->id)
                        ->where('via_bayar', 'tf-manual')
                        ->where('bukti_bayar', '!=', null)
                        ->where('pesanan.status', 'unpaid')
                        ->count();

                    $jml_kost = $kost
                        ->join('pemilik as a', 'a.id', 'kost.id_pemilik')
                        ->join('users as b', 'b.id', 'a.user_id')
                        ->where('user_id', usr())->count();

                    return view('dasboard-pemilik', compact('jml_kost', 'konf', 'pesanan', 'trx'));
                }elseif(Auth::user()->role == 'Admin') {
                    $kost=Kost::count();
                    $pemilik=Pemilik::join('users as a', 'a.id', 'pemilik.user_id')->where('a.status', 'aktif')->count();
                    $jenis_kost=JenisKost::count();
                    $penghuni=Penghuni::count();

                    $pesanan = Pesanan::join('kost as a', 'a.id', 'pesanan.id_kost')
                    ->select(
                        'pesanan.*',
                        'a.nama_kost',
                        'a.id_pemilik',
                        'c.no_tlp',
                        'd.email',
                        'd.name as nama_penghuni'
                    )
                    ->join('penghuni as c', 'c.id', 'pesanan.id_penghuni')
                    ->join('users as d', 'd.id', 'c.user_id')
                    ->where('pesanan.via_bayar','midtrans')
                    // ->where('pesanan.status','paid')
                    ->orderBy('pesanan.id', 'desc');
                    // dd($pesanan);

                    $trx = $pesanan->get();

                    // dd($pemilik);
                    // $trx = $pesanan->where('a.id_pemilik', $id_pemilik->id)->orderBy('pesanan.id', 'desc')->get();

                    return view('dasboard', compact('kost','pemilik','penghuni','jenis_kost','trx'));
                }else{
                    $data = Kost::all();
                    return view('customer.dashboard', compact('data'));
                }
            }
        }else{
            $data = Kost::all();
            return view('customer.dashboard', compact('data'));

        }
    }

    public function coordinate()
    {

        // if( !empty($request->latitude) ){
        //     $lat=$request->latitude;
        // }

        // if( !empty($request->longitude) ){
        //     $lng=$request->longitude;
        // }
        if (!empty($request->latitude)) {
            $lat = Request::all();;
        }


        dd($lat);
        if (!empty($request->longitude)) {
            $lng = Input::get('longtitude');
        }

        return $lat . ', ' . $lng;
    }



    public function index_()
    {
        $penjualan = Penjualan::orderBy('id', 'DESC')->get();
        $brg = Barang::orderBy('id', 'DESC')->get();
        $kategori = Kategori::orderBy('id', 'DESC')->count();
        $rak = Rak::orderBy('id', 'DESC')->count();
        $transaksi = Penjualan::orderBy('id', 'DESC')->count();
        $barang = Barang::orderBy('id', 'DESC')->count();

        // dd($barang, $rak);
        return view('dasboard', compact('penjualan', 'kategori', 'rak', 'barang', 'transaksi', 'brg'));
    }
}

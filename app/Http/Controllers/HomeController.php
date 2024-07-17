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
use App\Models\User;
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
                    $id_pemilik = User::where('id', Auth::user()->id)->where('role','Pemilik')->first();
                    $id_pem = $id_pemilik->id;
                    // dd($id_pemilik);
                    $id_penghuni = User::where('id', Auth::user()->id)->where('role', 'Penghuni')->first();
                    $pesanan = Pesanan:: whereHas('kost', function ($query) use ($id_pem) {
                        $query->where('id_pemilik', $id_pem);
                    });
                        $trx = $pesanan->get();
                        // dd($trx);

                    // $konf = $pesanan->where('a.id_pemilik', $id_pemilik->id)
                    //     ->where('via_bayar', 'tf-manual')
                    //     ->where('bukti_bayar', '!=', null)
                    //     ->where('pesanan.status', 'unpaid')
                    //     ->count();

                    $jml_kost = Kost::where('id_pemilik', $id_pem)->count();

                    return view('dasboard-pemilik', compact('jml_kost', 'pesanan', 'trx'));
                }elseif(Auth::user()->role == 'Admin') {
                    $kost=Kost::count();
                    $pemilik=User::where(['status'=>'aktif', 'role'=> 'Pemilik'])->count();
                    $penghuni=User::where(['role'=> 'Penghuni'])->count();
                    $jenis_kost=JenisKost::count();
                    // $penghuni=Penghuni::count();

                    $pesanan = Pesanan::orderBy('pesanan.id', 'desc');
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

    public function coordinate(Request $request)
    {

        // if( !empty($request->latitude) ){
        //     $lat=$request->latitude;
        // }

        // if( !empty($request->longitude) ){
        //     $lng=$request->longitude;
        // }
        if (!empty($request->latitude)) {
            // $lat = Request::all();
            $lat = $request->all();
        }


        dd($lat);
        if (!empty($request->longitude)) {
            $lng = $request->input('longtitude');
        }

        return $lat . ', ' . $lng;
    }



    // public function index_()
    // {
    //     $penjualan = Penjualan::orderBy('id', 'DESC')->get();
    //     $brg = Barang::orderBy('id', 'DESC')->get();
    //     $kategori = Kategori::orderBy('id', 'DESC')->count();
    //     $rak = Rak::orderBy('id', 'DESC')->count();
    //     $transaksi = Penjualan::orderBy('id', 'DESC')->count();
    //     $barang = Barang::orderBy('id', 'DESC')->count();

    //     // dd($barang, $rak);
    //     return view('dasboard', compact('penjualan', 'kategori', 'rak', 'barang', 'transaksi', 'brg'));
    // }
}

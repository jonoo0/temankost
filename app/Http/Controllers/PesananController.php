<?php

namespace App\Http\Controllers;

use App\Models\Kost;
use App\Models\Penghuni;
use App\Models\Pesanan;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Pemilik;
use Illuminate\Support\Facades\Auth;

class PesananController extends Controller
{

    public function index(Request $req)
    {

        // dd(1);
        $id_pemilik = User::where(['role' => 'Pemilik', 'id' => Auth::user()->id])->first();
        $id_penghuni = User::where(['role' => 'Penghuni', 'id' => Auth::user()->id])->first();
        $pesanan = Pesanan::orderBy('id', 'DESC');
        
        if($id_pemilik)$id_pem = $id_pemilik->id;

        if (Auth::user()->role == 'Admin') {
            $data = $pesanan->where('via_bayar', 'midtrans')->get();
            return view('pesanan.index', compact('data'));
        }


        if (Auth::user()->role == 'Pemilik') {

            if ($req->dtl) {
                $data = $pesanan->where('id', $req->dtl)
                               ->whereHas('kost', function ($query) use ($id_pemilik) {
                                   $query->where('id_pemilik', $id_pemilik->id);
                               })->get();
                return view('pesanan.index', compact('data'));
            }
            if ($req->via) {
                $data = Pesanan::where('via_bayar', $req->via)
                    ->whereHas('kost', function ($query) use ($id_pem) {
                        $query->where('id_pemilik', $id_pem);
                    })
                    ->get();
                return view('pesanan.index', compact('data'));
            }
        }
        if (Auth::user()->role == 'Penghuni') {
            $data = $pesanan->where('id_penghuni', $id_penghuni->id)->get();
            // dd($data);
            return view('customer.kost.pesanan', compact('data'));
        }
    }




    public function pembayaran(Request $req)
    {

        $snapToken = $req->snap;
        $data = Pesanan::findorfail($req->idd);

        $geocode = new \OpenCage\Geocoder\Geocoder(env('GEOCODE_CLIENT_KEY'));
        $result = $geocode->geocode($data->kost->lokasi);
        $final_lokasi = $result['results'][0]['formatted'];

        // dd($data);

        return view('customer.kost.invoice', compact('data', 'snapToken', 'final_lokasi'));
    }

    public function update(Request $req, $id)
    {

        if ($req->hasFile('file')) {
            if ($req->file('file')->isValid()) {
                $nm = $req->file;
                $imgName = $nm->getClientOriginalName();
                $req->file->move(public_path('nota'), $imgName);
                $data = Pesanan::findorfail($id);
                $data->update([
                    'bukti_bayar' => $imgName,
                    'status' => 'menunggu',
                ]);
            }
        }
        return redirect()->route('home.index')->with(['t' =>  'info', 'm' => 'Pembayaran berhasil. tunggu proses konfirmasi oleh pemilik']);
    }
    public function konfirmasi(Request $req)
    {


        $data = Pesanan::where('id', $req->id);
        $data->update(['status' => $req->status]);


        $kost = Kost::where('id', $req->id_kost)->first();
        $kost->update(['jumlah_kamar' => $kost->jumlah_kamar - 1]);

        return redirect()->back()->with(['t' =>  'info', 'm' => 'Konfirmasi Berhasil']);
    }

    public function store(Request $req)
    {

        $date = $req->tgl_mulai;

        $newDate = date('Y-m-d', strtotime($date . ' + ' . $req->jml_bulan . ' months'));

        $kost = Kost::where('id', $req->id_kost)->first();

        $penghuni = User::where('id', Auth::user()->id)->first();

        $last_id = Pesanan::orderBY('id', 'DESC')->pluck('id')->first();
        $in = 'TR-';
        $kd = $in . sprintf("%03s", $kost->id) . '-' . sprintf("%04s", $last_id + 1);
        $data = new Pesanan();
        $data->kode_trx = $kd;
        $data->id_penghuni = $penghuni->id;
        $data->tgl_mulai = $req->tgl_mulai;
        $data->tgl_selesai = $newDate;
        $data->id_kost = $req->id_kost;
        $data->jml_bulan = $req->jml_bulan;
        $data->via_bayar = $req->via_bayar;
        $data->status = 'unpaid';

        $data->nominal = $kost->tarif_perbulan * $req->jml_bulan;

        $data->save();

        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;


        $user = User::where('id', Auth::user()->id)->first();

        $params = array(
            'transaction_details' => array(
                'order_id' => $data->kode_trx,
                'gross_amount' => $data->nominal,
            ),
            'customer_details' => array(
                'first_name' => $user->name,
                'email' => $user->email,
                'phone' => $user->no_tlp,
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        $data->update([
            'snap_token' => $snapToken
        ]);

        return redirect()->to('pesanan/pembayaran?idd=' . $data->id . '&snap=' . $snapToken);
        // return view('customer.kost.invoice', compact('data', 'snapToken'));
    }

    function callback(Request $req)
    {
        $serverKey = config('midtrans.server_key');
        $hashed = hash("sha512", $req->order_id . $req->status_code . $req->gross_amount . $serverKey);
        if ($hashed == $req->signature_key) {
            if ($req->transaction_status == 'settlement' || $req->transaction_status == 'capture') {
                $order = Pesanan::where('kode_trx', $req->order_id)->first();
                $order->update(['status' => 'paid']);

                $kost = Kost::where('id', $order->id_kost)->first();
                $kost->update(['jumlah_kamar' => $kost->jumlah_kamar - 1]);
            }
            if ($req->transaction_status == 'pending') {
                $order = Pesanan::where('kode_trx', $req->order_id)->first();
                $order->update(['status' => 'pending']);
            }
            if ($req->transaction_status == 'expire') {
                $order = Pesanan::where('kode_trx', $req->order_id)->first();
                $order->update(['status' => 'expire']);
            }
        }
    }
}

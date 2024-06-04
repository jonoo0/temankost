<?php

namespace App\Http\Controllers;

use App\Models\Kost;
use App\Models\JenisKost;
use App\Models\Kategori;
use App\Models\Gambar;
use App\Models\Kamar;
use App\Models\Pesanan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KostController extends Controller
{

    public function coordinate(Request $request)
{

    $lat = '-7.817781893677779';
    $lng = '110.4078435106305';

    if( !empty($request->latitude) ){
        $lat=$request->latitude;
    }

    if( !empty($request->longitude) ){
        $lng=$request->longitude;
    }

    return $lat.', '.$lng;
}





    public function index()
    {

        $idd = Auth::user()->id;
        $cek_pemilik =  DB::table('users as a')->select('a.*', 'b.id as id_pemilik')->join('pemilik as b', 'a.id', 'b.user_id')->where(['a.id' => $idd])->first();
        $data = Kost::orderBy('id', 'desc');

        if(Auth::user()->role == 'Admin') $data = $data->get();
        if(Auth::user()->role == 'Pemilik') $data = $data->where(['id_pemilik' => $cek_pemilik->id_pemilik])->get();
        return view('kost.index', compact('data'));
    }

    public function create()
    {
        $jenis = JenisKost::all();
        $user = DB::table('users as a')->select('a.*', 'b.id as id_pemilik')->join('pemilik as b', 'a.id', 'b.user_id')->where('role', 'Pemilik')->get();

        return view('kost.create', compact('jenis', 'user'));
    }

    public function store(Request $request)
    {
        $cek = (explode(", ",$request->lokasi));
        $data = new Kost();
        $data->nama_kost = $request->nama_kost;
        $data->jenis_kost_id = $request->jenis_kost_id;
        $data->jumlah_kamar = $request->jumlah_kamar;
        $data->luas = $request->luas;
        $data->tarif_perbulan = $request->tarif_perbulan;
        $data->fasilitas_kost = $request->fasilitas_kost;
        $data->id_pemilik = $request->pemilik_id;
        $data->keterangan = $request->keterangan;
        $data->lokasi = $request->lokasi;
        $data->lat = $cek[0];
        $data->long = $cek[1];
        $data->save();
            $image = array();
            if ($file = $request->file('file')) {
                $jum = count($request->file('file'));
                foreach ($file as $f) {
                    $image_name = md5(rand(1000, 10000));
                    $ext = strtolower($f->getClientOriginalExtension());
                    $image_full_name = $image_name . '.' . $ext;
                    $uploade_path = 'uploads/images/';
                    $image_url = $uploade_path . $image_full_name;
                    $f->move($uploade_path, $image_full_name);
                    $image[] = $image_url;
                }
                for ($i = 0; $i < $jum; $i++) {
                    Gambar::create([
                            'id_kost' => $data->id,
                            'file' => $image[$i]
                        ]);
                }
            }


            // for ($i=1; $i <= $request->jumlah_kamar; $i++) {
            //     Kamar::create([
            //         'nama' => 'Kamar ' .$i,
            //         'kost_id' => $data->id,
            //         'sts' => 0,
            //     ]);
            // }



        return redirect()->route('kost.index')
        ->with(['t' =>  'success', 'm'=> 'Data berhasil ditambah']);
    }

    public function show(Kost $kost)
    {
        $data = Kost::find($kost->id);
        $dekat = 0;
        return view('kost.detail', compact('data'));
    }


    public function detail_penghuni(Kost $kost)
    {
        $data = Pesanan::
        join('penghuni as a', 'pesanan.id_penghuni', 'a.id')
        ->join('users as b', 'a.user_id', 'b.id')
        ->join('kost as c', 'pesanan.id_kost', 'c.id')
        ->select(['pesanan.*', 'b.name', 'b.email', 'a.no_tlp', 'c.nama_kost'])
        ->where([
            'id_kost' => $kost->id,
            'pesanan.status' => 'paid',
        ])->get();

        // dd($data);
        return view('kost.detail_penghuni', compact('data'));
    }


    public function edit(Request $request, $id)
    {
        $jenis = JenisKost::all();
        $user = DB::table('users as a')->select('a.*', 'b.id as id_pemilik')->join('pemilik as b', 'a.id', 'b.user_id')->where('role', 'Pemilik')->get();
        $data = Kost::where('id',$id)->first();
        return view('kost.edit', compact('data','jenis', 'user'));
    }

    public function update(Request $request, $id)
    {


    $preload = $request->preloaded;
    // dd($preload);
        if($preload !=null){
            $images = Gambar::where('id_kost', $id)
            -> whereNotIn('file', $preload)->delete();
        }elseif($preload == null){
            Gambar::where('id_kost', $id)->delete();
        }
        $variasi = $request['id_variasi'];
        if($variasi != null){
            $a =json_encode($variasi);
        }else{
            $a = NULL;
        }

        $data = Kost::where('id',$id)->first();
        $updt = $data->update([
                'nama_kost' => $request->get('nama_kost'),
                'jenis_kost_id' => $request->get('jenis_kost_id'),
                'jumlah_kamar' => $request->get('jumlah_kamar'),
                'luas' => $request->get('luas'),
                'tarif_perbulan' => $request->get('tarif_perbulan'),
                'fasilitas_kost' => $request->get('fasilitas_kost'),
                'keterangan' => $request->get('keterangan'),
                'lokasi' => $request->get('lokasi'),

            ]);

            // dd($data->id);
            $image = array();
            if ($file = $request->file('file')) {
                $jum = count($request->file('file'));
                foreach ($file as $f) {
                    $image_name = md5(rand(1000, 10000));
                    $ext = strtolower($f->getClientOriginalExtension());
                    $image_full_name = $image_name . '.' . $ext;
                    $uploade_path = 'uploads/images/';
                    $image_url = $uploade_path . $image_full_name;
                    $f->move($uploade_path, $image_full_name);
                    $image[] = $image_url;
                }

                for ($i = 0; $i < $jum; $i++) {
                    Gambar::create([
                            'id_kost' => $data->id,
                            'file' => $image[$i]
                        ]);
                }
            }
        return redirect()->route('kost.index')
        ->with(['t' =>  'success', 'm'=> 'Data berhasil diupdate']);
    }

    public function destroy(Request $request)
    {
        $data = Kost::findorFail($request->id);

        $data->delete();


        return redirect()->route('kost.index')
        ->with(['t' =>  'success', 'm'=> 'Data berhasil dihapus']);
    }
}

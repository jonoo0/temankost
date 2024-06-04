<?php

namespace App\Http\Controllers;

use App\Models\Kost;
use App\Models\JenisKost;
use Illuminate\Http\Request;

class JenisKostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = JenisKost::all();
        return view('jenis.index',compact('data'));
    }

    public function store(Request $request)
    {
        $data = new JenisKost();
        $data->jenis = $request->jenis;
        $data->save();
        return redirect()->route('jenis.index')->with(['t' =>  'success', 'm'=> 'Data berhasil ditambah']);;
    }

    public function update(Request $request)
    {
        $data = JenisKost::where('id', $request->get('id'))
        ->update([
            'jenis'=>$request->get('jenis'),
        ]);
        return redirect()->route('jenis.index')
                         ->with(['t' =>  'success', 'm'=> 'Data berhasil diupdate']);
    }
    public function destroy(Request $request)
    {
        $notification = array(
            'm' => 'Pastikan data tidak sedang digunakan!',
            't' => 'error'
        );
        $data = JenisKost::findorFail($request->id);

        $kost = Kost::where('jenis_kost_id', $data->id)->exists();//variabel kost digunakan untuk mengecek apakah data rak terdapat pada data kost
        if($kost == false){
            $data->delete();
            return redirect()->route('jenis.index')
            ->with(['t' =>  'success', 'm'=> 'Data berhasil dihapus']);
        }else{
            return redirect()->back()->with($notification);
        }
    }
}

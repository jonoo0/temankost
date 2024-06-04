<?php

namespace App\Http\Controllers;

use App\Models\Kost;
use App\Models\Pemilik;
use App\Models\Penghuni;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenghuniController extends Controller
{
    public function index()
    {


        $penghuni = Penghuni::orderBy('id', 'desc');

        $id_pemilik = Pemilik::join('users as a', 'a.id', 'pemilik.user_id')
        ->select('pemilik.id')
        ->where('a.id',Auth::user()->id)->first();

        // $penghuni = Penghuni::
        // join('users as a', 'a.id', 'penghuni.user_id')
        // ->join('pesanan as b', 'b.id_penghuni', 'penghuni.id')
        //     ->join('kost as c', 'c.id', 'b.id_kost')

        //     ->where('status', 'paid')
        //     ->select([
        //     'penghuni.*',
        //     'a.name',
        //     'a.email',
        //     'c.nama_kost',
        //     'b.tgl_mulai'
        //     ])

        // ->where('a.role', 'penghuni')
        // ->orderBy('a.id', 'desc');

        if(Auth::user()->role == 'Admin') $data = $penghuni->get();
        // if(Auth::user()->role == 'Pemilik')$data = $penghuni ->where('c.id_pemilik',$id_pemilik->id )->get();

        return view('penghuni.index', compact('data'));
    }

    public function create()
    {
        return view('penghuni.create');
    }

    public function store(Request $request)
    {
        $data = new User();
        $data->name = $request->nama;
        $data->role = 'Penghuni';
        $data->email = $request->email;
        $data->password = bcrypt('password');
        $data->save();

        $penghuni = new Penghuni();
        $penghuni->user_id = $data->id;
        $penghuni->no_tlp = $request->no_tlp;
        $penghuni->alamat = $request->alamat;
        $penghuni->save();
        return redirect()->route('penghuni.index')
        ->with(['t' =>  'success', 'm'=> 'Data berhasil ditambah']);
    }

    public function edit(Request $request, $id)
    {
        $data = Penghuni::where('id',$id)->first();
        return view('penghuni.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {

        $data = Penghuni::where('id',$id)->first();
        $data->update([
                'no_tlp' => $request->get('no_tlp'),
                'alamat' => $request->get('alamat'),
            ]);

            if($request->password){
                User::where('id', $data->user_id)->update([
                       'email' => $request->get('email'),
                       'name' => $request->get('nama'),
                       'password' => bcrypt($request->get('password')),
                   ]);
                }else{
                User::where('id', $data->user_id)->update([
                       'email' => $request->get('email'),
                       'name' => $request->get('nama'),
                   ]);
            }


        return redirect()->route('penghuni.index')
        ->with(['t' =>  'success', 'm'=> 'Data berhasil diupdate']);
    }

    public function destroy(Request $request)
    {
        $data = Penghuni::findorFail($request->id);
        $data->delete();
        return redirect()->route('penghuni.index')
        ->with(['t' =>  'success', 'm'=> 'Data berhasil dihapus']);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Pemilik;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PemilikController extends Controller
{
    public function index(Request $request)
    {


        $pemilik = Pemilik::
        join('users as a', 'a.id', 'pemilik.user_id')
        ->select([
            'pemilik.*',
            'a.name',
            'a.email',
            'a.status',
        ])
        ->where('a.role', 'pemilik')
        ->orderBy('a.id', 'desc');


        if($request->konfirmasi == 'menunggu'){
            $data = $pemilik->where('status', 'menunggu')->get();
        }else{
            $data = $pemilik->get();
        }

        return view('pemilik.index', compact('data'));
    }

    public function create()
    {
        return view('pemilik.create');
    }

    public function store(Request $request)
    {
        $data = new User();
        $data->name = $request->nama;
        $data->role = 'Pemilik';
        $data->email = $request->email;
        $data->status = Auth::user()->role == 'Admin' ? 'aktif' : 'menunggu';
        $data->password = bcrypt('password');
        $data->save();

        $pemilik = new Pemilik();
        $pemilik->user_id = $data->id;
        $pemilik->no_tlp = $request->no_tlp;
        $pemilik->no_rek = $request->no_rek;
        $pemilik->alamat = $request->alamat;
        $pemilik->save();
        return redirect()->route('pemilik.index')
        ->with(['t' =>  'success', 'm'=> 'Data berhasil ditambah']);
    }

    public function edit(Request $request, $id)
    {
        $data = Pemilik::where('pemilik.id',$id)->join('users as a', 'a.id', 'pemilik.user_id')
        ->select('pemilik.*', 'a.status')

        ->first();
        return view('pemilik.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = Pemilik::where('id',$id)->first();
        $data->update([
                'no_tlp' => $request->get('no_tlp'),
                'no_rek' => $request->get('no_rek'),
                'alamat' => $request->get('alamat'),
            ]);

         User::where('id', $data->user_id)->update([
                'email' => $request->get('email'),
                'status' => $request->get('status'),
                'name' => $request->get('nama'),
                'name' => $request->get('nama'),
            ]);

        return redirect()->route('pemilik.index')
        ->with(['t' =>  'success', 'm'=> 'Data berhasil diupdate']);
    }

    public function destroy(Request $request)
    {
        $data = Pemilik::findorFail($request->id);
        $data->delete();
        return redirect()->route('pemilik.index')
        ->with(['t' =>  'success', 'm'=> 'Data berhasil dihapus']);
    }
}

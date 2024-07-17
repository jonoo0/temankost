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


        $pemilik = User::where('role', 'pemilik')
        ->orderBy('id', 'desc');
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
        $data->no_tlp = $request->no_tlp;
        $data->no_rek = $request->no_rek;
        $data->alamat = $request->alamat;
        $data->save();
        return redirect()->route('pemilik.index')
        ->with(['t' =>  'success', 'm'=> 'Data berhasil ditambah']);
    }

    public function edit(Request $request, $id)
    {
        $data = User::findOrFail($id);
                return view('pemilik.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
     
         User::where('id', $id)->update([
                'email' => $request->get('email'),
                'status' => $request->get('status'),
                'name' => $request->get('nama'),
                'name' => $request->get('nama'),
                'no_tlp' => $request->get('no_tlp'),
                'no_rek' => $request->get('no_rek'),
                'alamat' => $request->get('alamat'),
            ]);

        return redirect()->route('pemilik.index')
        ->with(['t' =>  'success', 'm'=> 'Data berhasil diupdate']);
    }

    public function destroy(Request $request)
    {
        $data = User::findorFail($request->id);
        $data->delete();
        return redirect()->route('pemilik.index')
        ->with(['t' =>  'success', 'm'=> 'Data berhasil dihapus']);
    }
}

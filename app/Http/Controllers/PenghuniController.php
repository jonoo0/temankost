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
        $penghuni = User::orderBy('id', 'desc')->where('role','Penghuni');
        if(Auth::user()->role == 'Admin') $data = $penghuni->get();
        if(Auth::user()->role == 'Pemilik') $data = $penghuni->get();
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
        $data->no_tlp = $request->no_tlp;
        $data->alamat = $request->alamat;
        $data->save();
        return redirect()->route('penghuni.index')
        ->with(['t' =>  'success', 'm'=> 'Data berhasil ditambah']);
    }

    public function edit(Request $request, $id)
    {
        $data = User::findOrFail($id);
        return view('penghuni.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {

        $data = User::findOrFail($id);
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

            // dd($data);

        return redirect()->route('penghuni.index')
        ->with(['t' =>  'success', 'm'=> 'Data berhasil diupdate']);
    }

    public function destroy(Request $request)
    {
        $data = User::findorFail($request->id);
        $data->delete();
        return redirect()->route('penghuni.index')
        ->with(['t' =>  'success', 'm'=> 'Data berhasil dihapus']);
    }
}

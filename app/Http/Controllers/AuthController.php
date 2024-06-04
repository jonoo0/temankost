<?php

namespace App\Http\Controllers;

use App\Models\Penghuni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Rules\MatchOldPassword;
use App\Models\Pemilik;
use Symfony\Component\Console\Input\Input;

class AuthController extends Controller
{
    public function authenticate(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'email' => 'required|email',
                'password' => 'required|string',
            ],
            [
                'password.required' => 'Password wajib diisi',
                'email.required' => 'email wajib diisi',
                'email.email' => 'format email tidak sesuai',

            ]

        );
        if ($validator->fails()) {
            return back()->withErrors($validator)
                ->withInput();
        } else {
            $credentials = $request->only('email', 'password');
            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                return redirect()->route('home.index');
            } else {
                return Redirect()->back()->with(
                    [
                        'error' => 'Email atau Password Salah'
                    ]
                );
            }
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
    public function login()
    {
        return view('login');
    }
    public function register()
    {
        return view('register');
    }
    public function register_post(Request $request)
    {

        // dd($_POST);
        $validator = Validator::make(
            $request->all(),
            [
                'email' => 'required|email|unique:users',
                'name' => 'required',
                'alamat' => 'required',
                'no_tlp' => 'required',
                'password' => 'required|string',
                're-password' => 'required|string|same:password',
            ],
            [
                'password.required' => 'Password wajib diisi',
                'name.required' => 'Nama wajib diisi',
                'alamat.required' => 'Alamat wajib diisi',
                'no_tlp.required' => 'No Tlp wajib diisi',
                're-password.required' => 'Re Password wajib diisi',
                're-password.same' => 'Re Password harus sama dengan password',
                'email.required' => 'email wajib diisi',
                'email.email' => 'format email tidak sesuai',
                'email.unique' => 'Email sudah digunakan',

            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)
                ->withInput();
        } else {
            $data = new User();
            $data->name = $request->name;
            $data->role = $request->role;
            $data->email = $request->email;
            $data->password = bcrypt($request->password);
            $data->save();

            if ($data->role == 'Pemilik') {
                $pemilik = new Pemilik();
                $pemilik->user_id = $data->id;
                $pemilik->no_tlp = $request->no_tlp;
                $pemilik->no_rek = $request->rekening;
                $pemilik->alamat = $request->alamat;
                $pemilik->save();
            }
            if ($data->role == 'Penghuni') {
                $penghuni = new Penghuni();
                $penghuni->user_id = $data->id;
                $penghuni->no_tlp = $request->no_tlp;
                $penghuni->alamat = $request->alamat;
                $penghuni->save();
            }

            return redirect()->route('login')
                ->with(['t' =>  'success', 'm' => 'Registrasi Sukses']);
        }
    }


    public function profile()
    {
        return view(Auth::user()->role == 'Penghuni' ? 'customer.profile' :  'profile');

    }
    public function ubahpwstore(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'password_lama' => ['required', new MatchOldPassword],
                'password_baru' => ['required'],
                'konfirmasi_password' => ['same:password_baru', 'required'],
            ],
            [
                'password_lama.required' => 'password lama harus diisi',
                'password_baru.required' => 'password baru harus diisi',
                'konfirmasi_password.required' => 'konfirmasi password harus diisi',
                'konfirmasi_password.same' => 'konfirmasi password harus sama dengan password baru',
            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)
                ->withInput();
        }
        User::find(Auth::user()->id)->update(['password' => Hash::make($request->password_baru)]);
        return redirect()->route('logout.auth')->with('success', 'Silahkan login ulang degan password yang baru.');
    }
}

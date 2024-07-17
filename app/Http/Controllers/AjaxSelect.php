<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Pemilik;
use App\Models\User;

class AjaxSelect extends Controller
{
    function notif()
    {
        $a = usr();
        $pemilik = Pemilik::where('user_id', $a)->first();
        $e =  DB::table('pesanan as a')
            ->join('kost as b', 'b.id', 'a.id_kost')
            ->where('a.bukti_bayar', '!=', null)
            ->where([
                'b.id_pemilik' => $pemilik->id,
                'a.status' => 'menunggu',
                'a.via_bayar' => 'tf-manual',
                // 'a.bukti_bayar' => '!=', null,
            ]);
        $task = $e->count() ?: null;
        $jml = $task;
        $out = ['status' => false];
        if ($task) $out = [
            'status' => true,
            'data' => compact('task'),
            'jumlah' => $jml
        ];
        return json_encode($out);
    }
    function notif_admin()
    {
        $e =  DB::table('users as a')
            ->where([
                'a.role' => 'pemilik',
                'a.status' => 'menunggu',
            ]);
        $count = $e->count() ?: null;
        $jml = $count;
        $out = ['status' => false];
        if ($count) $out = [
            'status' => true,
            'data' => compact('count'),
            'jumlah' => $jml
        ];
        return json_encode($out);
    }
}

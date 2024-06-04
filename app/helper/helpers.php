<?php

use Illuminate\Support\Facades\Auth;

function tgl($date){
    // Carbon\Carbon::parse($data->tgl_catatan_sipil)->isoFormat('D MMM Y')
    return \Carbon\Carbon::parse($date)->isoFormat('D MMMM Y');
}
function tgls($date){
    // Carbon\Carbon::parse($data->tgl_catatan_sipil)->isoFormat('D MMM Y')
    return \Carbon\Carbon::parse($date)->isoFormat('D MMM Y');
}
function usr(){
    return Auth::user()->id;
}

function uriaktif($uri=''){
    if(is_array($uri)) return in_array(Request::segment(1), $uri) ? 'active' : '';
    return Request::segment(1)== $uri ? 'active' : '';
}


function str_replace_first($search, $replace, $subject)
    {
        $search = '/'.preg_quote($search, '/').'/';
        return preg_replace($search, $replace, $subject, 1);
    }



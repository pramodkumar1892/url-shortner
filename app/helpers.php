<?php

use Illuminate\Support\Facades\URL;

if(!function_exists('create_short_code')){

    function create_short_code($length = 5){
        return substr(str_shuffle(str_repeat("ABCDEFGHJKMNOPQURSTUVWXYZabcdefghjkmnopqrstuvwxyz", 5)), 0, $length);
    }
}

if(!function_exists('build_short_url')){

    function build_short_url($shortCode, $prefix = 'short'){
        return URL::to('/') . "/$prefix/" . $shortCode;
    }
}

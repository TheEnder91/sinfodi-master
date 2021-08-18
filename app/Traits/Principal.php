<?php
namespace App\Traits;

use Illuminate\Support\Facades\Session;

trait Principal {
    public static function getUrlToken($url = ''){
        return config('app.url').$url.'?token='.Session::get('token');
    }
}

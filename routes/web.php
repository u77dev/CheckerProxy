<?php

use App\Proxy;
use App\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $r = Proxy::find(1319);
//    $r = Proxy::find(1);
    dump($r);
    dd($r->checkProxy());

    return view('welcome');
});

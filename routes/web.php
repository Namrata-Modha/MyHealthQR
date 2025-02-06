<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/healthz', function (Request $request) {
    return response()->json(['status' => 'ok'], 200);
});
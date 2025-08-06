<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TemplateController;



// route::get('/',[TemplateController::class,'index']);

Route::get('/', function () {
    return view('home');
});

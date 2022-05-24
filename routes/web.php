<?php

use App\Container;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Test;
use App\TestFacade;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create    something great!
|
*/

Route::get('/', function(){
    // dd(TestFacade::execute());
    return view('welcome');
});


Route::resource('posts', HomeController::class)->middleware(['auth:sanctum','verified']);

Route::get('logout',[AuthController::class,'logout']);


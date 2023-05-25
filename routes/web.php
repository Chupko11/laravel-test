<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\AuthorController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


//Kada osoba otvori stranicu, prvo što se otvori je welcome view.
Route::get('', function () {
    return view('welcome');
});


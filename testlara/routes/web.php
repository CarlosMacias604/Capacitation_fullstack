<?php

use App\Http\Controllers\Dashboard\PostController;
use App\Http\Controllers\PrimerControlador;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('post', PostController::class);

//CREA UN CRUD DE LAS RUTAS CON SOLO UNA LINEA DE CODIGO
//Route::resource('post', PrimerControlador::class);


// Route::get('/contact', function () {
//     FORMAS DE REDIRECCIONAR A OTRA RUTA
//     return redirect('/contact2', 302);
//     return redirect()->route('contact2');
//     return to_route('contact2');

//     return view('contact', ['name' => 'Carlos']);
// })->name('contact');


// Route::get('/contact2', function () {
//     return view('contact2');
// })->name('contact2');
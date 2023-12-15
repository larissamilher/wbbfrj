<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});


Route::get('/', function () {
    return view('site.index');
})->name('home');

Route::get('/categorias', function () {
    return view('site.categorias');
})->name('categorias');

Route::get('/quem-somos', function () {
    return view('site.quem-somos');
})->name('quem-somos');

Route::get('/quem-somos/comissao', function () {
    return view('site.comissao');
})->name('comissao');

Route::get('/filiacao', function () {
    return view('site.filiacao');
})->name('filiacao');

Route::get('/campeonatos', function () {
    return view('site.campeonatos');
})->name('campeonatos');

Route::get('/calendario', function () {
    return view('site.calendario');
})->name('calendario');

Route::get('/como-competir', function () {
    return view('site.como-competir');
})->name('como-competir');

Route::get('/backstage-anual', function () {
    return view('site.backstage-anual');
})->name('backstage-anual');

Route::get('/inscricao', function () {
    return view('site.inscricao');
})->name('inscricao');

Route::get('/resultado-2023', function () {
    return view('site.resultado-2023');
})->name('resultado-2023');

Route::get('/educacao', function () {
    return view('site.educacao');
})->name('educacao');

Route::get('/curso-arbitros', function () {
    return view('site.curso-arbitros');
})->name('curso-arbitros');

Route::get('/contato', function () {
    return view('site.contato');
})->name('contato');

Route::get('/categoria/classic-physique', function () {
    return view('site.classic-physique');
})->name('classic-physique');
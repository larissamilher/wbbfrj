<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Site\InscricaoController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AtletasController;
use App\Http\Controllers\Admin\CampeonatosController;
use App\Http\Controllers\Admin\CategoriasController;
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

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified',])->prefix('admin')->group(function () {

    Route::get('/dashboard', function () {return view('admin.dashboard');})->name('admin.dashboard');
    
    Route::get('/atletas', [AtletasController::class, 'index'])->name('admin.atletas');

    Route::prefix('campeonatos')->group(function () {
        Route::get('/', [CampeonatosController::class, 'index'])->name('admin.campeonatos');
        Route::get('/novo', [CampeonatosController::class, 'create'])->name('admin.campeonato.novo');
    });

    Route::prefix('categorias')->group(function () {
        Route::get('/', [CategoriasController::class, 'index'])->name('admin.categorias');
        Route::get('/novo', [CategoriasController::class, 'create'])->name('admin.categoria.novo');
    });
});

Route::get('/', function () {
    return view('site.index');
})->name('home');

Route::prefix('categorias')->group(function () {
    
    Route::get('/', function () {
        return view('site.categorias');
    })->name('categorias');

    Route::get('/classic-physique', function () {
        return view('site.classic-physique');
    })->name('classic-physique');
});

Route::prefix('quem-somos')->group(function () {
    Route::get('/', function () {
        return view('site.quem-somos');
    })->name('quem-somos');
    
    Route::get('/comissao', function () {
        return view('site.comissao');
    })->name('comissao');
});

Route::get('/filiacao', function () {
    return view('site.filiacao');
})->name('filiacao');

Route::prefix('campeonatos')->group(function () {
    Route::get('/', function () {
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
    
    Route::prefix('inscricao')->group(function () {
        Route::get('/', [InscricaoController::class, 'index'])->name('inscricao');
        Route::get('/get-categorias-campeonato/{campeonatoId}', [InscricaoController::class, 'getCategoriasCampeonato']);
    });

    Route::prefix('resultados')->group(function () {
        Route::get('/2023', function () {
            return view('site.resultado-2023');
        })->name('resultado-2023');
    });
});

Route::prefix('educacao')->group(function () {
    Route::get('/', function () {
        return view('site.educacao');
    })->name('educacao');

    Route::get('/curso-arbitros', function () {
        return view('site.curso-arbitros');
    })->name('curso-arbitros');
});

Route::get('/contato', function () {
    return view('site.contato');
})->name('contato');
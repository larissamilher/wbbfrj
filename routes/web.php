<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Site\InscricaoController;
use App\Http\Controllers\Site\SiteController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AtletasController;
use App\Http\Controllers\Admin\CampeonatosController;
use App\Http\Controllers\Admin\CategoriasController;
use App\Http\Controllers\Admin\InscricoesController;
use App\Http\Controllers\Admin\UsuariosController;

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
//         // 'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

Auth::routes(['register' => false]);


Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified',])->prefix('admin')->group(function () {
    
    Route::prefix('dashboard')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
    });

    Route::prefix('atletas')->group(function () {
        Route::get('/', [AtletasController::class, 'index'])->name('admin.atletas');
    });

    Route::prefix('inscricoes')->group(function () {
        Route::get('/', [InscricoesController::class, 'index'])->name('admin.inscricoes');
        Route::get('/extrair-listagem', [InscricoesController::class, 'extrairListagemTela'])->name('admin.inscricoes.extrair-listagem');
        Route::post('/extrair-listagem-acao', [InscricoesController::class, 'extrairListagem'])->name('admin.inscricoes.extrair-listagem-acao');
        Route::get('/detalhes/{id}', [InscricoesController::class, 'detalhes'])->name('admin.inscricoes.detalhes');
        Route::get('/gerar-pdf/{id}', [InscricoesController::class, 'gerarPdf'])->name('admin.inscricoes.gerar-pdf');

    });    

    Route::prefix('campeonatos')->group(function () {
        Route::get('/', [CampeonatosController::class, 'index'])->name('admin.campeonatos');
        Route::get('/novo', [CampeonatosController::class, 'create'])->name('admin.campeonato.novo');
        Route::get('/edit/{id}', [CampeonatosController::class, 'edit'])->name('admin.campeonato.edit');
        Route::get('/delete/{id}', [CampeonatosController::class, 'delete'])->name('admin.campeonato.delete');
        Route::post('/store', [CampeonatosController::class, 'store'])->name('admin.campeonato.store');

    });

    Route::prefix('categorias')->group(function () {
        Route::get('/', [CategoriasController::class, 'index'])->name('admin.categorias');
        Route::get('/novo', [CategoriasController::class, 'create'])->name('admin.categoria.novo');
        Route::get('/edit/{id}', [CategoriasController::class, 'edit'])->name('admin.categoria.edit');
        Route::get('/delete/{id}', [CategoriasController::class, 'delete'])->name('admin.categoria.delete');
        Route::post('/store', [CategoriasController::class, 'store'])->name('admin.categoria.store');
    });

    Route::prefix('usuarios')->group(function () {
        Route::get('/', [UsuariosController::class, 'index'])->name('admin.usuarios');
        Route::get('/novo', [UsuariosController::class, 'create'])->name('admin.usuario.novo');
        Route::post('/store', [UsuariosController::class, 'store'])->name('admin.usuario.store');
        Route::get('/delete/{id}', [UsuariosController::class, 'delete'])->name('admin.usuario.delete');
    });

});


Route::get('/', function () {
    return view('site.index');
})->name('home');

Route::prefix('categorias')->group(function () {
    
    Route::get('/', function () {
        return view('site.categorias');
    })->name('categorias');

    Route::get('/bikini', function () { return view('site.categoria.bikini'); })->name('categoria.bikini');
    Route::get('/super-model', function () { return view('site.categoria.super_model'); })->name('categoria.super_model');
    Route::get('/wellness', function () { return view('site.categoria.wellness'); })->name('categoria.wellness');
    Route::get('/bodybuilder', function () { return view('site.categoria.bodybuilder'); })->name('categoria.bodybuilder');
    Route::get('/classic', function () { return view('site.categoria.classic'); })->name('categoria.classic');
    Route::get('/mens-physique', function () { return view('site.categoria.mens_physique'); })->name('categoria.mens_physique');
    Route::get('/summer-shape', function () { return view('site.categoria.summer_shape'); })->name('categoria.summer_shape');
    Route::get('/super-body', function () { return view('site.categoria.super_body'); })->name('categoria.super_body');
    Route::get('/up-shape', function () { return view('site.categoria.up_shape'); })->name('categoria.up_shape');
    
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
        Route::match(['get', 'post'],'/ficha', [InscricaoController::class, 'primeiraEtapaInscricao'])->name('inscricao.store.ficha');
        Route::post('/pagamento', [InscricaoController::class, 'etapaPagamento'])->name('inscricao.pagamento');

        Route::get('/teste', [InscricaoController::class, 'teste'])->name('teste');

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

Route::post('/getcep', [InscricaoController::class, 'getcep'])->name('getcep');
Route::post('/formulario-contato', [SiteController::class, 'contato'])->name('formulario-contato');


Auth::routes();


<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categoria;

class CategoriasController extends Controller
{
    public function index(){
        $categorias = Categoria::all();

        return view('admin.categorias.index', compact("categorias"));
    }

    public function create(){
        return view('admin.categorias.novo');
    }
}

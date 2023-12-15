<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InscricaoCampeonato;

class AtletasController extends Controller
{
    public function index(){

        $atletas = InscricaoCampeonato::all();

        return view('admin.atletas.index', compact('atletas'));
    }
}

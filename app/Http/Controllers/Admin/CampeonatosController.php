<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Campeonato;

class CampeonatosController extends Controller
{
    public function index(){

        $campeonatos = Campeonato::all();

        return view('admin.campeonatos.index', compact('campeonatos'));
    }

    public function create(){
        return view('admin.campeonatos.novo');
    }
}

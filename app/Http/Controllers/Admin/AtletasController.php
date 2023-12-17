<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Atleta;

class AtletasController extends Controller
{
    public function index(){

        $atletas = Atleta::all();

        return view('admin.atletas.index', compact('atletas'));
    }
}

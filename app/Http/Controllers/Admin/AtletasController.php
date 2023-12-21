<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Atleta;
use PhpOffice\PhpSpreadsheet\Exception;

class AtletasController extends Controller
{
    public function index(){

        $atletas = Atleta::orderBy('nome')->get();

        return view('admin.atletas.index', compact('atletas'));
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UsuariosController extends Controller
{
    public function index()
    {
        $usuarios = User::all(); 

        return view('admin.usuarios.index', compact("usuarios"));
    }

    public function create()
    {
        $usuarios = User::all(); 

        return view('admin.usuarios.novo');
    }

    public function store(Request $request)
    {
        // $user = new User();
        // $user->name     = $request->input('name');
        // $user->email    = $request->input('email');
        // $user->password = bcrypt($request->input('password'));

        // return view('admin.usuarios.index', compact("usuarios"));
    }
    
}

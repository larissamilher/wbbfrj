<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\CriacaoUsuarioAdmin;
use Illuminate\Support\Facades\Log;

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
        $response = [
            'success' => true,
            'message' => '',
            'class' => 'msg-sucesso',
        ];

        try {
            $senha = Str::random(8);
        
            $user = User::where('email', $request->input('email'))->first();
        
            if ($user) 
                throw new \Exception('Já existe um usuário cadastrado com esse email!');
            
            $user = new User();
            $user->name     = $request->input('name');
            $user->email    = $request->input('email');
            $user->permissao_create_user = $request->input('permissao_create_user');
            $user->password = bcrypt($senha);
            
            $user->save();

            Mail::to($request->input('email'))->send(new CriacaoUsuarioAdmin([
                'senha' => $senha,
                'email' => $request->input('email'),
                'url' => 'https://wbbfrj.com/login'
            ]));
        
            $response['message'] = 'Usuário criado com sucesso! Os dados de acesso serão enviados para o email: '.$request->input('email') ;

        } catch (\Exception $e) {
            Log::error($e);
            $response =  [
                'success' => false,
                'message' => $e->getMessage(),
                'class' => 'msg-error',
            ];
        }

        return view('admin.usuarios.novo', compact('response'));
    }
    
    public function delete($id){

        $response = [
            'success' => true,
            'message' => '',
            'class' => '',
        ];

        try {

            $user = User::find($id);

            if ($user) 
                $user->delete();
            
            $response['message'] = 'Usuário deletado com sucesso!';
            $response['class']= 'msg-sucesso';
        }
        catch (Exception $e) {
            Log::error($e);
            $response =  [
                'success' => false,
                'message' => 'Ops! Parece que houve. Por favor, tente novamente mais tarde.',
                'class' => 'msg-error',
            ];
        }
    
        return redirect()->route('admin.usuarios')->with('response', $response);
    }
}

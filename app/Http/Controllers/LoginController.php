<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{   
    public function checkauthcontrol(){
        if(Auth::check()){
            return redirect()->route('padm');
        }else{
            return redirect()->route('vlogin');
        }
    }
    public function viewlogin(){
        return view('login');
    }
    public function checkcreden(Request $req){

        $dados = $req->all();

        $username = $dados['nome'];
        $pass = $dados['pass'];
        
        $creden = [
            "user" => $username,
            "password" => $pass
        ];
     
        if(Auth::attempt($creden)){
            return redirect()->route('padm');
        }else{
            return redirect()->back()->withErrors(['dados inválidos']);;
        }

    }
    public function logout(){
        Auth::logout();
        return redirect()->route('vlogin');
    }
    public function getpainel(){
        $users = DB::table('users')->where('type',2)->get(['id','name','copiasmes','copiasrestante']);
        $relatorio = DB::table('relatorios')->get(['action','user','quant','created_at']);
        return view('painel',['usuarios' => $users,'registro' => $relatorio]);
    }
    public function getpaineluser(){
        return view('paineluser');
    }
    public function getperfil(){
        return view('perfil');
    }

}

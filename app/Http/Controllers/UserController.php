<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function cadUser(Request $req){
        
       $dados = $req->all();
       $reqname = $dados['nome'];
       $requsername = $dados['username'];
       $reqpass = $dados['pass'];

       if($reqpass == "" or $reqname == "" or $requsername == ""){
           return response()->json(['msgnotok'=>'dados vazios']);
       }else{
           $veri = DB::table('users')->where('user',$requsername)->count();
           if($veri > 0){
               return response()->json(['msgnotok'=>'este nome de usuário já existe']);
           }else{
               $user = new User();
               $user->name = $reqname;
               $user->user = $requsername;
               $user->password = bcrypt($reqpass);
               $user->type = 2;
               $user->copiasmes = 0;
               $user->copiasrestante = 0;
               $user->save();
           }
       }
    }
    public function editinfoUser(Request $req){
        $dados = $req->all();
        $newreqname = $dados['nome'];
        $newrequsername = $dados['username'];

        if($newreqname == "" && $newrequsername == ""){
            return response()->json(['msgnotok' => "preencha pelo menos um campo"]);
        }else{
            if($newreqname != "" && $newrequsername != ""){
               
                $veri = DB::table('users')->where('user',$newrequsername)->count();
                
                if($veri > 0){
                    return response()->json(['msgnotok'=>'este nome de usuário já existe']);
                }else{
                    $user = User::find(Auth::id());
                    $user->name = $newreqname;
                    $user->user = $newrequsername;
                    $user->save();          
                }        
            }else{
                if($newrequsername != ""){
                    
                    $veri = DB::table('users')->where('user',$newrequsername)->count();
                    if($veri > 0){
                        return response()->json(['msgnotok'=>'este nome de usuário já existe']);
                    }else{
                        $user = User::find(Auth::id());
                        $user->user = $newrequsername;
                        $user->save();
                    }
                }else{
                    $user = User::find(Auth::id());
                    $user->name = $newreqname;
                    $user->save();
                }
            }
        }
    }
    public function editpassUser(Request $req){
        $dados = $req->all();
        $reqpassatual = $dados['pass'];
        $reqnewpass = $dados['newpass'];

        if($reqpassatual == "" or $reqnewpass == ""){
            return response()->json(['msgnotok' => "preencha todos os campos"]);
        }else{

            $user = User::find(Auth::id());

            if(Hash::check($reqpassatual,$user->password)){
                $user->password = bcrypt($reqnewpass);
                $user->save();
            }else{
                return response()->json(['msgnotok' => "a senha atual está errada"]);
            }
        }
    }
}

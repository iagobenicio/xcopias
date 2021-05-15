<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class CopiasController extends Controller
{
    public function renovarCp(Request $req){
        $datas = $req->all();
        $user = User::find($datas['id']);
        
        if(is_numeric($datas['quantidade'])){
            $user->copiasmes = $datas['quantidade'];
            $user->copiasrestante = $datas['quantidade'];
            $user->save();
        }else{
            return response()->json(['msgnotok' => 'tipo de valor não permitido']);
        }

    }
    public function retornarCp(Request $req){
        $datas = $req->all();
        $user = User::find($datas['id']);

        if(is_numeric($datas['quantidade'])){
            $newquant = $datas['quantidade'] + $user->copiasrestante;
            if($datas['quantidade'] > 0 && $user->copiasmes >= $newquant){
                $user->copiasrestante = $newquant;
                $user->save();
            }else{
                return response()->json(['msgnotok' => 'quantidade inválida']);
            }

        }else{
            return response()->json(['msgnotok' => 'tipo de valor não permitido']);
        }



    }
    public function retirarCp(Request $req){
        $datas = $req->all();
        $user = User::find($datas['id']);

        if(is_numeric($datas['quantidade'])){
            
            if($datas['quantidade'] > 0 && $user->copiasrestante >= $datas['quantidade']){
                $newquant = $user->copiasrestante - $datas['quantidade'];
                $user->copiasrestante = $newquant;
                $user->save();
            }else{
                return response()->json(['msgnotok' => 'quantidade inválida']);
            }

        }else{
            return response()->json(['msgnotok' => 'tipo de valor não permitido']);
        }

    }
}

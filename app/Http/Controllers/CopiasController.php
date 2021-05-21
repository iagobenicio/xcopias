<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Relatorio;
use Illuminate\Support\Facades\DB;

class CopiasController extends Controller
{
    public function renovarCp(Request $req){
        $datas = $req->all();
        $user = User::find($datas['id']);

        if(is_numeric($datas['quantidade'])){
            try {
                DB::beginTransaction();
                $user->copiasmes = $datas['quantidade'];
                $user->copiasrestante = $datas['quantidade'];
                $user->save();

                $registro = new Relatorio();
                $registro->action = "Retornada de cópias";
                $registro->user = $user->name;
                $registro->quant = $datas['quantidade'];
                $registro->userid = $user->id;
                $registro->save();
                DB::commit();
            } catch (\Throwable $th) {
                DB::rollBack();
            }
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
                try {
                    DB::beginTransaction();
                    $user->copiasrestante = $newquant;
                    $user->save();

                    $registro = new Relatorio();
                    $registro->action = "Retornada de cópias";
                    $registro->user = $user->name;
                    $registro->quant = $datas['quantidade'];
                    $registro->userid = $user->id;
                    $registro->save();
                    DB::commit();
                } catch (\Throwable $th) {
                    DB::rollBack();
                }
                
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
                try {
                    DB::beginTransaction();
                    $newquant = $user->copiasrestante - $datas['quantidade'];
                    $user->copiasrestante = $newquant;
                    $user->save();

                    $registro = new Relatorio();
                    $registro->action = "Retirada de cópias";
                    $registro->user = $user->name;
                    $registro->quant  = $datas['quantidade'];
                    $registro->userid = $user->id;
                    $registro->save();
                    DB::commit();
                } catch (\Throwable $th) {
                    DB::rollBack();
                }

            }else{
                return response()->json(['msgnotok' => 'quantidade inválida']);
            }

        }else{
            return response()->json(['msgnotok' => 'tipo de valor não permitido']);
        }

    }
}

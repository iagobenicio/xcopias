<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CopiasController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',[LoginController::class,'checkauthcontrol'])->name('init');
Route::get('/login',[LoginController::class,'viewlogin'])->name('vlogin');
Route::post('/checklogin',[LoginController::class,'checkcreden']);

Route::get('/painel',[LoginController::class,'getpainel'])->middleware('auth')->middleware('verifiadm')->name('padm');
Route::get('/paineluser',[LoginController::class,'getpaineluser'])->middleware('auth')->name('puser');
Route::get('/perfil',[LoginController::class,'getperfil'])->middleware('auth');
Route::get('/logout',[LoginController::class,'logout'])->middleware('auth');

Route::post('/caduser',[UserController::class,'cadUser'])->middleware('auth')->middleware('verifiadm')->name('cduser');
Route::post('/useredit/info',[UserController::class,'editinfoUser'])->middleware('auth')->name('userinfo');
Route::post('/useredit/pass',[UserController::class,'editpassUser'])->middleware('auth')->name('userpass');

Route::post('/retirarcp',[CopiasController::class,'retirarCp'])->middleware('auth')->middleware('verifiadm')->name('rtcopias');
Route::post('/retornarcp',[CopiasController::class,'retornarCp'])->middleware('auth')->middleware('verifiadm')->name('rtocopias');
Route::post('/renovarcp',[CopiasController::class,'renovarCp'])->middleware('auth')->middleware('verifiadm')->name('rncopias');


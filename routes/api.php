<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\TimController;
use App\Http\Controllers\API\PemainController;
use App\Http\Controllers\API\JadwalPertandinganController;
use App\Http\Controllers\API\HasilPertandinganController;
use App\Http\Controllers\API\ReportPertandinganController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::controller(AuthController::class)->group(function(){
    Route::post('register', 'register');
    Route::post('login', 'login');
});
        
Route::middleware('auth:sanctum')->group( function () {
    Route::resource('tim', TimController::class);
    Route::get('tim/trash',[TimController::class,'trash']);
    Route::post('tim/{id}/restore',[TimController::class,'restore']);
    Route::delete('tim/{id}/delete',[TimController::class,'delete']);
    Route::resource('pemain', PemainController::class);
    Route::get('pemain/trash',[PemainController::class,'trash']);
    Route::post('pemain/{id}/restore',[PemainController::class,'restore']);
    Route::delete('pemain/{id}/delete',[PemainController::class,'delete']);
    Route::resource('jadwalpertandingan', JadwalPertandinganController::class);
    Route::get('jadwalpertandingan/trash',[JadwalPertandinganController::class,'trash']);
    Route::post('jadwalpertandingan/{id}/restore',[JadwalPertandinganController::class,'restore']);
    Route::delete('jadwalpertandingan/{id}/delete',[JadwalPertandinganController::class,'delete']);
    Route::resource('hasilpertandingan', HasilPertandinganController::class);
    Route::get('hasilpertandingan/trash',[HasilPertandinganController::class,'trash']);
    Route::post('hasilpertandingan/{id}/restore',[HasilPertandinganController::class,'restore']);
    Route::delete('hasilpertandingan/{id}/delete',[HasilPertandinganController::class,'delete']);
    Route::get('report',[TimController::class,'index']);
    Route::get('trport/{id}',[TimController::class,'show']);
});

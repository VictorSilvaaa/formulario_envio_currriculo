<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CurriculoController;
use App\Http\Controllers\EscolaridadeTiposController;

Route::get('/', function () {
    return response()->json(['message' => 'bem vindo a API!']);
});

Route::middleware('throttle:5,1')->post('/curriculos', [CurriculoController::class, 'store']);
Route::get('/escolaridades', [EscolaridadeTiposController::class, 'index']);
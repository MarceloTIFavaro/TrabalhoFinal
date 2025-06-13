<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EquipamentoController;
use App\Http\Controllers\ManutencaoController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

// ROTA COMPLETA PARA EQUIPAMENTOS (com autenticação para criar/editar/excluir)
Route::resource('equipamentos', EquipamentoController::class);

// ROTA COMPLETA PARA MANUTENÇÕES (com autenticação para criar/editar/excluir)
Route::resource('manutencoes', ManutencaoController::class)
    ->parameters(['manutencoes' => 'manutencao'])
    ->middleware(['auth']);

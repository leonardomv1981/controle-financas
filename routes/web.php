<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BancosController;
use App\Http\Controllers\BandeirasController;
use App\Http\Controllers\CartoesController;
use App\Http\Controllers\CategoriagastosController;
use App\Http\Controllers\ContasController;
use App\Http\Controllers\ContasrecorrentesController;
use App\Http\Controllers\MovimentacaocartoesController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
});


Route::get('/configuracoes', function () {
    return view('configuracoes');
})->name('configuracoes');

Route::prefix('bancos')->group(function () {
    Route::get('/', [BancosController::class, 'index'])->name('bancos.listar');
    Route::get('/cadastrar', [BancosController::class, 'cadastrar'])->name('bancos.cadastrar');
    Route::post('/cadastrar', [BancosController::class, 'cadastrar'])->name('bancos.cadastrar');
    Route::delete('/delete', [BancosController::class, 'delete'])->name('bancos.delete');
});

Route::prefix('bandeiras')->group(function () {
    Route::get('/', [BandeirasController::class, 'index'])->name('bandeiras.listar');
    Route::get('/cadastrar', [BandeirasController::class, 'cadastrar'])->name('bandeiras.cadastrar');
    Route::post('/cadastrar', [BandeirasController::class, 'cadastrar'])->name('bandeiras.cadastrar');
    Route::delete('/delete', [BandeirasController::class, 'delete'])->name('bandeiras.delete');
});

Route::prefix('cartoes')->group(function () {
    Route::get('/', [CartoesController::class, 'index'])->name('cartoes.listar');
    Route::get('/cadastrar', [CartoesController::class, 'cadastrar'])->name('cartoes.cadastrar');
    Route::post('/cadastrar', [CartoesController::class, 'cadastrar'])->name('cartoes.cadastrar');
    Route::delete('/delete', [CartoesController::class, 'delete'])->name('cartoes.delete');
});

Route::prefix('movimentacaocartoes')->group(function () {
    Route::get('/', [MovimentacaocartoesController::class, 'index'])->name('movimentacaocartoes.listar');
    Route::get('/cadastrar', [MovimentacaocartoesController::class, 'cadastrar'])->name('movimentacaocartoes.cadastrar');
    Route::post('/cadastrar', [MovimentacaocartoesController::class, 'cadastrar'])->name('movimentacaocartoes.cadastrar');
    Route::delete('/delete', [MovimentacaocartoesController::class, 'delete'])->name('movimentacaocartoes.delete');
});

Route::prefix('categoria-gastos')->group(function () {
    Route::get('/', [CategoriagastosController::class, 'index'])->name('categoria-gastos.listar');
    Route::get('/cadastrar', [CategoriagastosController::class, 'cadastrar'])->name('categoria-gastos.cadastrar');
    Route::post('/cadastrar', [CategoriagastosController::class, 'cadastrar'])->name('categoria-gastos.cadastrar');
    Route::delete('/delete', [CategoriagastosController::class, 'delete'])->name('categoria-gastos.delete');
});

Route::prefix('contas')->group(function () {
    Route::get('/', [ContasController::class, 'index'])->name('contas.listar');
    Route::get('/cadastrar', [ContasController::class, 'cadastrar'])->name('contas.cadastrar');
    Route::post('/cadastrar', [ContasController::class, 'cadastrar'])->name('contas.cadastrar');
    Route::delete('/delete', [ContasController::class, 'delete'])->name('contas.delete');
    Route::post('/pagar', [ContasController::class, 'pagar'])->name('contas.pagar');
});

Route::prefix('contas-recorrentes')->group(function () {
    Route::post('/pagar', [ContasrecorrentesController::class, 'pagar'])->name('contas-recorrentes.pagar');
    Route::DELETE('/delete', [ContasrecorrentesController::class, 'delete'])->name('contas-recorrentes.delete');
});
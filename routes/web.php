<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\Admin\ItemController as AdminItemController;
use App\Http\Controllers\Admin\DoadorController as AdminDoadorController;
use App\Http\Controllers\Admin\InstituicaoController as AdminInstituicaoController;
use App\Http\Controllers\Admin\EstoqueController as AdminEstoqueController;
use App\Http\Controllers\Admin\RelatorioController as AdminRelatorioController;
use App\Http\Controllers\Admin\CampCateController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rotas protegidas para administradores
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('/profile', AdminProfileController::class);
    Route::resource('/item', AdminItemController::class);
    Route::resource('/estoque', AdminEstoqueController::class);
    Route::resource('/relatorio', AdminRelatorioController::class);
    Route::put('/profile/password/update', [AdminProfileController::class, 'updatePassword'])->name('profile.password.update');

    // Doadores e Instituições
    Route::get('/doadores', [AdminDoadorController::class, 'index'])->name('doadores.index');
    Route::post('/doadores', [AdminDoadorController::class, 'store'])->name('doadores.store');
    Route::post('/instituicoes', [AdminInstituicaoController::class, 'store'])->name('instituicoes.store');

    // Cadastros Gerais - Categorias e Campanhas
    Route::get('/cadastros-gerais', [CampCateController::class, 'index'])->name('cadastros.index');
    Route::post('/categorias', [CampCateController::class, 'storeCategoria'])->name('categorias.store');
    Route::delete('/categorias/{id}', [CampCateController::class, 'destroyCategoria'])->name('categorias.destroy');
    Route::post('/tipos-campanha', [CampCateController::class, 'storeTipoCampanha'])->name('tipos-campanha.store');
    Route::delete('/tipos-campanha/{id}', [CampCateController::class, 'destroyTipoCampanha'])->name('tipos-campanha.destroy');
});

require __DIR__.'/auth.php';

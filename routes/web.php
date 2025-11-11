<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\AuditoriaController as AdminAuditoriaController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\Admin\ItemController as AdminItemController;
use App\Http\Controllers\Admin\DoadorController as AdminDoadorController;
use App\Http\Controllers\Admin\InstituicaoController as AdminInstituicaoController;
use App\Http\Controllers\Admin\EstoqueController as AdminEstoqueController;
use App\Http\Controllers\Admin\RelatorioController as AdminRelatorioController;
use App\Http\Controllers\Admin\CampCateController;
use App\Http\Controllers\Admin\ReceberDoacaoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/faleconosco', function () {
    return view('faleconosco');
});

Route::get('/roadmap', function () {
    return view('roadmap');
});

Route::get('/sobrenos', function () {
    return view('sobre-nos');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rotas acessíveis por todos os usuários autenticados (Admin, Gerente e Operador)
Route::middleware(['auth', 'operador'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard - todos podem acessar
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Perfil - todos podem gerenciar seu próprio perfil
    Route::resource('/profile', AdminProfileController::class);
    Route::put('/profile/password/update', [AdminProfileController::class, 'updatePassword'])->name('profile.password.update');

    // Doadores e Instituições
    Route::get('/doadores', [AdminDoadorController::class, 'index'])->name('doadores.index');
    Route::post('/doadores', [AdminDoadorController::class, 'store'])->name('doadores.store');
    Route::post('/instituicoes', [AdminInstituicaoController::class, 'store'])->name('instituicoes.store');

    // Estoque - todos podem visualizar
    Route::get('/estoque', [AdminEstoqueController::class, 'index'])->name('estoque.index');
    Route::get('/estoque/{id}', [AdminEstoqueController::class, 'show'])->name('estoque.show');

    // Gestão de Itens
    Route::resource('/item', AdminItemController::class);

    // Receber Doações - todos podem registrar doações recebidas
    Route::resource('receber-doacaos', ReceberDoacaoController::class);

    // Cadastros Gerais - Categorias e Campanhas
    Route::get('/cadastros-gerais', [CampCateController::class, 'index'])->name('cadastros.index');
    Route::post('/categorias', [CampCateController::class, 'storeCategoria'])->name('categorias.store');
    Route::put('/categorias/{id}', [CampCateController::class, 'updateCategoria'])->name('categorias.update');
    Route::delete('/categorias/{id}', [CampCateController::class, 'destroyCategoria'])->name('categorias.destroy');
    Route::post('/tipos-campanha', [CampCateController::class, 'storeTipoCampanha'])->name('tipos-campanha.store');
    Route::put('/tipos-campanha/{id}', [CampCateController::class, 'updateTipoCampanha'])->name('tipos-campanha.update');
    Route::delete('/tipos-campanha/{id}', [CampCateController::class, 'destroyTipoCampanha'])->name('tipos-campanha.destroy');
});


// Rotas acessíveis por Admin e Gerente
Route::middleware(['auth', 'gerente'])->prefix('admin')->name('admin.')->group(function () {

    // Relatórios
    Route::resource('/relatorio', AdminRelatorioController::class);
});

// Rotas exclusivas para Admin
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Gestão de Usuários - apenas Admin
    Route::resource('/users', AdminUserController::class);

    // Auditoria - apenas Admin
    Route::resource('/auditoria', AdminAuditoriaController::class);
});

require __DIR__ . '/auth.php';

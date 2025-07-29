<?php

use App\Http\Controllers\{ProdutoController, CategoriaController, CarrinhoController, LoginController, DashboardController};
use Illuminate\Support\Facades\Route;

Route::redirect('/', 'produtos')->name('home');
Route::resource('produtos', controller: ProdutoController::class);
Route::get('produtos/details/{slug}', [ProdutoController::class, 'details'])->name('produtos.details');
Route::get('categoria/{id}', [CategoriaController::class, 'categoria'])->name('categorias.produtos');
Route::get('carrinho', [CarrinhoController::class, 'listaCarrinho'])->name('carrinho');
Route::post('carrinho', [CarrinhoController::class, 'addCarrinho'])->name('carrinho.add');
Route::post('remover', [CarrinhoController::class, 'removeCarrinho'])->name('carrinho.remover');
Route::post('atualizar', [CarrinhoController::class, 'atualizaCarrinho'])->name('carrinho.atualizar');
Route::get('limpar', [CarrinhoController::class, 'limparCarrinho'])->name('carrinho.limpar');

Route::post('salvar-dados', [CarrinhoController::class, 'salvar'])->name('salvar-dados');

Route::view('login', view: 'login.form')->name('login.form');
Route::post('auth', [LoginController::class, 'auth'])->name('login.auth');

Route::get('admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

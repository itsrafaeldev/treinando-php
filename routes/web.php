<?php

use App\Http\Controllers\{ProdutoController, CategoriaController, CarrinhoController, LoginController, DashboardController, UserController};
use Illuminate\Support\Facades\Route;

Route::redirect('/', 'produtos')->name('home');
// Route::resource('produtos', controller: ProdutoController::class);
Route::get('produtos/details/{slug}', [ProdutoController::class, 'details'])->name('produtos.details');
Route::get('categoria/{id}', [CategoriaController::class, 'categoria'])->name('categorias.produtos');
Route::get('carrinho', [CarrinhoController::class, 'listaCarrinho'])->name('carrinho');
Route::post('carrinho', [CarrinhoController::class, 'addCarrinho'])->name('carrinho.add');
Route::post('remover', [CarrinhoController::class, 'removeCarrinho'])->name('carrinho.remover');
Route::post('atualizar', [CarrinhoController::class, 'atualizaCarrinho'])->name('carrinho.atualizar');
Route::get('limpar', [CarrinhoController::class, 'limparCarrinho'])->name('carrinho.limpar');

Route::post('salvar-dados', [CarrinhoController::class, 'salvar'])->name('salvar-dados');

Route::view('login', view: 'login.form')->name('login.form');
Route::get('logout', [LoginController::class, 'logout'])->name('login.logout');
Route::post('auth', [LoginController::class, 'auth'])->name('login.auth');
Route::view('register', 'login.register')->name('login.register');
Route::post('create', [UserController::class, 'create'])->name('login.create');



Route::get('admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard')->middleware('auth');
Route::get('admin/produtos', [ProdutoController::class, 'index'])->name('admin.produtos');
Route::delete('admin/produto/delete/{produto}', [ProdutoController::class, 'destroy'])->name('admin.produto.delete');
Route::post('admin/produto/create', [ProdutoController::class, 'create'])->name('admin.produto.create');
Route::post('admin/produto/store', [ProdutoController::class, 'store'])->name('admin.produto.store');


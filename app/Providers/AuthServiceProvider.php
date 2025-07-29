<?php

namespace App\Providers;

use App\Models\Produto;
use App\Models\User;
use App\Policies\ProdutoPolicy;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Gate::policy(Produto::class, ProdutoPolicy::class);
        // Gate::define('ver-produto', function (User $user, Produto $produto) {
        //     return $user->id === $produto->id_user;
        // });
    }
}

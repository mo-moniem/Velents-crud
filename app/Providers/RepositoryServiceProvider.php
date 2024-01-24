<?php

namespace App\Providers;

use App\Repositories\Contracts\AuthContract;
use App\Repositories\SQL\AuthRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Contracts\UserContract;
use App\Repositories\SQL\UserRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(UserContract::class , UserRepository::class);
        $this->app->bind(AuthContract::class , AuthRepository::class);
//        $this->app->bind([
//            UserContract::class=> UserRepository::class,
//            AuthContract::class=> AuthRepository::class
//        ]);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}

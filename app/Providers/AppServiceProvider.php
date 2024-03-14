<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\UsersInterface;


use App\Repository\UsersRepository;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UsersInterface::class, UsersRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}

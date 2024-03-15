<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\UsersInterface;
use App\Interfaces\AnimesInterface;

use App\Repository\UsersRepository;
use App\Repository\AnimesRepository;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UsersInterface::class, UsersRepository::class);
        $this->app->bind(AnimesInterface::class, AnimesRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}

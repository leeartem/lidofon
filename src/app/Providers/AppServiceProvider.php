<?php

namespace App\Providers;

use App\Interfaces\IUserRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(IUserRepository::class, UserRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void {}

    public function provides(): array
    {
        return [
            IUserRepository::class,
        ];
    }
}

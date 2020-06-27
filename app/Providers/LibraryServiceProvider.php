<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\BookRepository;
use App\Repositories\UserRepository;

class LibraryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind('App\Repositories\BookRepository', function ($app) {
            return new BookRepository();
        });
        $this->app->bind('App\Repositories\UserRepository', function ($app) {
            return new UserRepository();
        });
    }
}

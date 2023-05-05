<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Repositories\Interfaces\ProductRepositoryInterface',
            'App\Repositories\ProductRepository'
        );
        $this->app->bind(
            'App\Repositories\Interfaces\ProductOptionRepositoryInterface',
            'App\Repositories\ProductOptionRepository'
        );
        $this->app->bind(
            'App\Repositories\Interfaces\VariantRepositoryInterface',
            'App\Repositories\VariantRepository'
        );
        $this->app->bind(
            'App\Repositories\Interfaces\ProductImageRepositoryInterface',
            'App\Repositories\ProductImageRepository'
        );
        $this->app->bind(
            'App\Repositories\Interfaces\CollectionRepositoryInterface',
            'App\Repositories\CollectionRepository'
        );
        $this->app->bind(
            'App\Repositories\Interfaces\CollectRepositoryInterface',
            'App\Repositories\CollectRepository'
        );
        $this->app->bind(
            'App\Repositories\Interfaces\UserRepositoryInterface',
            'App\Repositories\UserRepository'
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

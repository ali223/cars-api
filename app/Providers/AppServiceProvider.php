<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
             'App\Repositories\CarModelsRepositoryInterface',
             'App\Repositories\CarModelsJsonRepository'
        );

        $this->app->bind('App\Repositories\JsonDataSource', 
            function($app) {
                return new \App\Repositories\JsonDataSource('../database/data/models_and_cars.json');
            }
        );

        $this->app->bind('App\Repositories\DataSourceInterface',
            function($app) {
                return $app->make('App\Repositories\JsonDataSource');
            }
        );

    }
}

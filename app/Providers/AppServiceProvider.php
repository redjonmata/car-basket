<?php

namespace App\Providers;

use App\Cars;
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
        $this->app->bind(Cars\CarsRepository::class, function ($app) {
            if (! config('services.search.enabled')) {
                return new Cars\EloquentRepository();
            }
        });

        $this->bindSearchClient();
    }

    private function bindSearchClient()
    {
//        $this->app->bind(Client::class, function ($app) {
//            return ClientBuilder::create()
//                ->setHosts($app['config']->get('services.search.hosts'))
//                ->build();
//        });
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

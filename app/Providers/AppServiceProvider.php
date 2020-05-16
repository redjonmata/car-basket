<?php

namespace App\Providers;

use App\Cars;
//use Elasticsearch\Client;
//use Elasticsearch\ClientBuilder;
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
//            if (! config('services.search.enabled')) {
                return new Cars\EloquentRepository();
//            }

//            return new Cars\ElasticsearchRepository(
//                $app->make(Client::class)
//            );
        });

//        $this->bindSearchClient();
    }

//    private function bindSearchClient()
//    {
//        $this->app->bind(Client::class, function ($app) {
//            return ClientBuilder::create()
//                ->setHosts($app['config']->get('services.search.hosts'))
//                ->build();
//        });
//    }

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

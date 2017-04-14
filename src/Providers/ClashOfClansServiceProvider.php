<?php
/**
 * Created by PhpStorm.
 * User: donnie
 * Date: 4/3/17
 * Time: 18:02
 */

namespace ClashOfClans\Providers;

use ClashOfClans\ClashOfClans;
use ClashOfClans\Endpoints\Clans;
use ClashOfClans\Endpoints\LocationsEndpoint;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use ClashOfClans\Endpoints\PlayersEndpoint;

class ClashOfClansServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../../config/config.php' => config_path('coc.php'),
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('ClashOfClans', function ($app) {
            return new ClashOfClans();
        });

        $this->app->booting(function () {
            $loader = AliasLoader::getInstance();
            $loader->alias('ClashOfClans', \ClashOfClans\Facades\ClashOfClans::class);
        });

        $this->app->register(ApiServiceProvider::class);
    }
}
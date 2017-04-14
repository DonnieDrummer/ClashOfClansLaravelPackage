<?php
/**
 * Created by PhpStorm.
 * User: donnie
 * Date: 4/4/17
 * Time: 11:36
 */

namespace ClashOfClans\Providers;

use GuzzleHttp\Client;
use ClashOfClans\Endpoints\ClansEndpoint;
use ClashOfClans\Endpoints\PlayersEndpoint;
use ClashOfClans\Endpoints\LocationsEndpoint;
use Illuminate\Support\ServiceProvider;

class ApiServiceProvider extends ServiceProvider
{
    protected static $endpoints = [
        ClansEndpoint::class, PlayersEndpoint::class, LocationsEndpoint::class,
    ];
    /**
     * Publish configuration.
     */
    public function boot()
    {

    }

    /**
     * Register all of the endpoints in the service container.
     */
    public function register()
    {
        $api_client = new Client([
            'base_uri' => config('coc.base_url'),
            'timeout'  => 5.0,
        ]);

        foreach (self::$endpoints as $endpoint) {
            $this->app->singleton($endpoint, function () use ($api_client, $endpoint) {
                return new $endpoint($api_client);
            });
        }
    }
}
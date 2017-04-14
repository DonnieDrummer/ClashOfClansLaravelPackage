<?php
/**
 * Created by PhpStorm.
 * User: donnie
 * Date: 4/3/17
 * Time: 17:58
 */

namespace ClashOfClans;

use ClashOfClans\Endpoints\ClansEndpoint;
use ClashOfClans\Endpoints\LocationsEndpoint;
use ClashOfClans\Endpoints\PlayersEndpoint;
use ClashOfClans\Models\Clan;
use Illuminate\Support\Collection;

/**
 * Class ClashOfClans
 * @package ClashOfClans
 */
class ClashOfClans
{
    protected $data;

    /**
     * @param array $params
     *
     * @return \Illuminate\Support\Collection
     */
    public function clans(array $params = []): Collection
    {
        return (new Clan())->all($params);
    }

    public function clan($tagName)
    {
        return (app()->make(ClansEndpoint::class))->get($tagName);
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: donnie
 * Date: 4/3/17
 * Time: 18:01
 */

namespace ClashOfClans\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class ClashOfClans
 * @package ClashOfClans\Facades
 */
class ClashOfClans extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'ClashOfClans';
    }
}
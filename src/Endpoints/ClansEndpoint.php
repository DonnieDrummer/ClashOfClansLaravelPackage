<?php
/**
 * Created by PhpStorm.
 * User: donnie
 * Date: 4/3/17
 * Time: 18:07
 */

namespace ClashOfClans\Endpoints;

use ClashOfClans\Contracts\ApiEndpoint;

/**
 * Clans Endpoint
 *
 * @package ClashOfClans\Endpoints
 */
class ClansEndpoint extends ApiEndpoint
{
    /**
     * Available filters for search clans
     */
    const FILTERS = ['name', 'warFrequency', 'locationId', 'minMembers', 'maxMembers', 'minClanPoints',
        'minClanLevel', 'limit', 'limit', 'before'];

    /**
     *
     */
    const WAR_FREQUENCY_ALWAYS = 'always';
    /**
     *
     */
    const WAR_FREQUENCY_MORE_THAN_ONCE_PER_WEEK = 'moreThanOncePerWeek';
    /**
     *
     */
    const WAR_FREQUENCY_ONCE_PER_WEEK = 'oncePerWeek';
    /**
     *
     */
    const WAR_FREQUENCY_LESS_THAN_ONCE_PER_WEEK = 'lessThanOncePerWeek';
    /**
     *
     */
    const WAR_FREQUENCY_NEVER = 'never';
    /**
     *
     */
    const WAR_FREQUENCY_UNKNOWN = 'unknown';

    protected $endpoint = 'clans';

}
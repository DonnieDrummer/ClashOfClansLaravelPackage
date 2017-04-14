<?php
/**
 * Created by PhpStorm.
 * User: donnie
 * Date: 4/5/17
 * Time: 17:17
 */

namespace ClashOfClans\Models;

use ClashOfClans\Contracts\Model;

class Clan extends Model
{
    public function setLocation($params)
    {
        return new Location($params);
    }
}
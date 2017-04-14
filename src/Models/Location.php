<?php
/**
 * Created by PhpStorm.
 * User: donnie
 * Date: 4/5/17
 * Time: 17:22
 */

namespace ClashOfClans\Models;

use ClashOfClans\Contracts\Model;

class Location extends Model
{
    protected $attributes = ['id', 'name', 'isCountry', 'countryCode'];

}
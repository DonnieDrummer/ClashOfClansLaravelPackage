<?php
/**
 * Created by PhpStorm.
 * User: donnie
 * Date: 4/3/17
 * Time: 18:16
 */

namespace ClashOfClans\Collections;

use Illuminate\Support\Collection;

/**
 * A collection of resources, along with meta data describing how filters have
 * been applied to the collection.
 */
class ApiCollection extends Collection
{
    /**
     * @var
     */
    private $meta;

    public function __construct($items = [], $params)
    {
        parent::__construct($items);
        $this->pagging = $params;
    }

    /**
     * Returns the metadata for the collection.
     */
    public function getMeta()
    {
        return $this->meta;
    }

}
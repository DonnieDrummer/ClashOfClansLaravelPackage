<?php
/**
 * Created by PhpStorm.
 * User: donnie
 * Date: 4/5/17
 * Time: 17:21
 */

namespace ClashOfClans\Contracts;

use ClashOfClans\Collections\ApiCollection;
use Illuminate\Support\Str;

abstract class Model
{
    protected $attributes;

    public function __construct(array $attributes = [])
    {
        $this->fill($attributes);
    }

    protected function fill(array $attributes)
    {
        foreach ($attributes as $key => $value) {
            $this->setAttribute($key, $value);
        }

        return $this;
    }

    protected function getClassAttributes(array $attributes)
    {
        return array_intersect_key($attributes, array_flip($this->attributes));
    }

    protected function setAttribute($key, $value)
    {

        if ($this->hasSetMutator($key)) {
            $method = 'set' . Str::studly($key);

            $this->attributes[$key] = $this->{$method}($value);
        }

        $this->attributes[$key] = $value;

        return $this;
    }

    /**
     * Determine if a set mutator exists for an attribute.
     *
     * @param  string $key
     *
     * @return bool
     */
    public function hasSetMutator($key)
    {
        return method_exists($this, 'set' . Str::studly($key));
    }

    public function all(array $params)
    {
        return $this->getEndpoint()->all($params);
    }

    /**
     * @param $models
     * @param $params
     *
     * @return ApiCollection
     */
    public function newCollection($models, $params)
    {
        return new ApiCollection($models, $params);
    }

    protected function getEndpoint()
    {
        $class = 'ClashOfClans\\Endpoints\\' . last(explode('\\', static::class)) . 'sEndpoint';

        return new $class($this);
    }

    /**
     * Create a new instance of the given model.
     *
     * @param  array  $attributes
     * @param  bool  $exists
     * @return static
     */
    public function newInstance($attributes = [], $exists = false)
    {
        return new static((array) $attributes);
    }

}
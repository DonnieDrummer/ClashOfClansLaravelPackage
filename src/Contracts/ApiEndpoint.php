<?php
/**
 * Created by PhpStorm.
 * User: donnie
 * Date: 4/3/17
 * Time: 18:19
 */

namespace ClashOfClans\Contracts;

use ClashOfClans\Collections\ApiCollection;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use ReflectionClass;
use GuzzleHttp\Client;
use Exception;

abstract class ApiEndpoint
{
    const FILTERS = [];

    private $client;

    protected $endpoint;

    protected $collection_type = ApiCollection::class;

    protected $model;

    /**
     * Construct a new API endpoint using the given HTTP client.
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->client = new Client([
            'base_uri' => config('coc.base_url'),
            'timeout'  => 5.0,
        ]);

        $this->model = $model;

        if (!$this->endpoint) {
            $this->endpoint = strtolower((new ReflectionClass($this))->getShortName());
        }
    }

    /**
     * Make a request to the endpoint.
     *
     * @param $method
     * @param $url
     * @param $payload
     *
     * @return Collection
     */
    protected function makeRequest($method, $url, $payload = [])
    {
        $payload = array_merge($payload, ['headers' => ['authorization' => 'Bearer ' . config('coc.token')]]);
        $response = $this->client->request($method, $url, $payload);
        $body = $response->getBody();

        return $this->hydrate(json_decode((string)$body, true));
    }

    /**
     * Returns the root URL of the endpoint.
     */
    protected function getUrl()
    {
        return $this->endpoint;
    }

    /**
     * Retrieve the entire collection, filtered according to the given query.
     *
     * @param $query array
     *
     * @return ApiCollection
     */
    public function all($query = [])
    {
        $url = $this->getCollectionUrl();

        foreach ($query as $key => $value) {
            if (!in_array($key, static::FILTERS)) {
                unset($query[$key]);
            }
        }

        return $this->makeRequest('GET', $url, ['query' => $query]);
    }

    /**
     * Retrieve a single resource from the collection, by unique identifier.
     *
     * @param $id
     * @param $query string|null
     *
     * @return array
     */
    public function get($id, $query = NULL)
    {
        $url = $this->getResourceUrl($id);
        $response = $this->makeRequest('GET', $url, ['query' => $query]);

        return $this->collection_type::fromResponse($response);
    }

    /**
     * Get the URL of the collection, which is the same of the root URl for
     * the endpoint.
     *
     * @return string
     */
    protected function getCollectionUrl()
    {
        return $this->getUrl();
    }

    /**
     * Get the URL of a resource in the collection, given the unique identifier
     * of the resource.
     *
     * @param $id integer
     *
     * @return string
     */
    protected function getResourceUrl($id)
    {
        return $this->getUrl() . '/' . $id;
    }

    public function getModel(): Model
    {
        return $this->model;
    }

    /**
     * Create a collection of models from plain arrays.
     *
     * @param  array  $response
     * @return \Illuminate\Support\Collection
     */
    public function hydrate(array $response)
    {
        $instance = $this->model->newInstance();

        return $instance->newCollection(array_map(function ($item) use ($instance) {
            return $instance->newInstance($item);
        }, $response['items']), $response['paging']);
    }
}
<?php

namespace App\Api\Builders;

use App\Api\Api;
use App\Criteria\Criteria;
use App\Criteria\Includes;
use App\Criteria\Limit;
use App\Criteria\Sort;

final class RequestBuilder
{
    /**
     * @var \App\Api\Api
     */
    private $api;

    /**
     * @var string
     */
    private $url;

    public function __construct(Api $api, $url)
    {
        $this->api = $api;
        $this->url = $url;
        $this->criteria = Criteria::make();
    }

    /**
     * @param string|int $limit
     * @return static
     */
    public function limit($limit)
    {
        $this->criteria->set(new Limit($limit));

        return $this;
    }

    /**
     * @param string $includes
     * @return static
     */
    public function includes($includes)
    {
        $this->criteria->set(new Includes($includes));

        return $this;
    }

    /**
     * @param mixed $fields
     * @return static
     */
    public function sort($fields)
    {
        $this->criteria->set(new Sort($fields));

        return $this;
    }

    /**
     * @param \App\Criteria\CriteriaOption|string $name
     * @param mixed $value
     * @return static
     */
    public function filter($name, $value = null)
    {
        $this->criteria->set($name, $value);

        return $this;
    }

    /**
     * @return mixed
     */
    public function get()
    {
        return $this->api->get($this->buildUrl());
    }

    /**
     * @return mixed
     */
    public function all()
    {
        return $this->limit(Limit::VALUE_ALL)->get();
    }

    /**
     * @return string
     */
    public function buildUrl()
    {
        $queryParams = $this->getQueryString();

        return $this->url . ($queryParams ? "?$queryParams" : '');
    }

    /**
     * @return string
     */
    private function getQueryString()
    {
        return implode('&', array_map(function(QueryParam $param) {
            return $param->queryString();
        }, $this->criteria->all()));
    }
}

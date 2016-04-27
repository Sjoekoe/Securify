<?php
namespace App\Api;

interface Api
{
    /**
     * Call an API endpoint using it's qualified URL. Note that the '/api/'
     * URL prefix will be added automatically if it's missing in the
     * given URL. The trailing slash is optional just as well.
     *
     * @param string $url
     * @return \App\Api\Builders\RequestBuilder
     */
    public function url($url);

    /**
     * Call an API URL using its route name. Note that, though you can add the
     * 'api.' prefix yourself, you don't need to. We'll add it automatically
     * if it hasn't been set.
     *
     * @param string $name
     * @param array $params
     * @return \App\Api\Builders\RequestBuilder
     */
    public function route($name, $params = []);

    /**
     * Decodes the content of the raw API response and returns it.
     *
     * @param string $url
     * @return mixed
     */
    public function get($url);
}

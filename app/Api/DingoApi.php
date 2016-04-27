<?php
namespace App\Api;

use App\Api\Builders\Exceptions\UrlException;
use App\Api\Builders\RequestBuilder;
use App\Users\User;
use Dingo\Api\Dispatcher;
use Dingo\Api\Routing\UrlGenerator;
use Illuminate\Support\Str;

class DingoApi implements Api
{
    /**
     * @var \Dingo\Api\Dispatcher
     */
    private $dispatcher;

    /**
     * @var \Dingo\Api\Routing\UrlGenerator
     */
    private $url;

    /**
     * @var \App\Users\User
     */
    private $user;

    public function __construct(Dispatcher $dispatcher, UrlGenerator $url, $version, User $user = null)
    {
        $this->dispatcher = $dispatcher;
        $this->url = $url->version($version);
        $this->user = $user;
    }

    /**
     * Call an API endpoint using it's qualified URL. Note that the '/api/'
     * URL prefix will be added automatically if it's missing in the
     * given URL. The trailing slash is optional just as well.
     *
     * @param string $url
     * @return \App\Api\Builders\RequestBuilder
     */
    public function url($url)
    {
        return new RequestBuilder($this, $this->validateUrl($url));
    }

    /**
     * Call an API URL using its route name. Note that, though you can add the
     * 'api.' prefix yourself, you don't need to. We'll add it automatically
     * if it hasn't been set.
     *
     * @param string $name
     * @param array $params
     * @return \App\Api\Builders\RequestBuilder
     */
    public function route($name, $params = [])
    {
        $name = ! Str::startsWith($name, 'api.') ? "api.$name" : $name;

        $url = $this->url->route($name, $params, false);

        return new RequestBuilder($this, $url);
    }

    /**
     * Decodes the content of the raw API response and returns it.
     *
     * @param string $url
     * @return mixed
     */
    public function get($url)
    {
        $response = $this->dispatcher->be($this->user)->raw()->get($url);

        return json_decode($response->getContent());
    }

    /**
     * @param string $url
     * @return mixed
     */
    private function validateUrl($url)
    {
        if (parse_url($url, PHP_URL_QUERY)) {
            throw UrlException::queryStringNotAllowed();
        }

        $url = ! Str::startsWith($url, '/') ? "/$url" : $url;

        if (! Str::startsWith($url, '/api/')) {
            $url = str_replace('//', '/', "/api/$url");
        }

        return rtrim($url, '?');
    }
}

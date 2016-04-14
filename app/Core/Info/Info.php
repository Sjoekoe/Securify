<?php
namespace App\Core\Info;

use App\Api\Accounts\AccountTransformer;
use App\JWT\TokenGenerator;
use Illuminate\Auth\AuthManager;
use Illuminate\Contracts\Config\Repository as Config;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Session\Store as Session;

class Info implements Jsonable
{
    /**
     * @var \Illuminate\Auth\AuthManager
     */
    private $auth;

    /**
     * @var \App\JWT\TokenGenerator
     */
    private $jwt;

    /**
     * @var \Illuminate\Session\Store
     */
    private $session;

    /**
     * @var \Illuminate\Contracts\Config\Repository
     */
    private $config;

    /**
     * @var string
     */
    private $key = 'securify.info';

    public function __construct(
        AuthManager $auth,
        TokenGenerator $jwt,
        Session $session,
        Config $config
    ) {
        $this->auth = $auth;
        $this->jwt = $jwt;
        $this->session = $session;
        $this->config = $config;
    }

    /**
     * @return array
     */
    public function get()
    {
        return array_merge($this->getDefaultInfo(), (array) $this->session->get($this->key));
    }

    /**
     * @param array|string $key
     * @param mixed $value
     */
    public function flash($key, $value = null)
    {
        if (is_array($key)) {
            foreach ($key as $sessionKey => $sessionValue) {
                $this->session->flash("{$this->key}.{$sessionKey}", $sessionValue);
            }
        } else {
            $this->session->flash("{$this->key}.{$key}", $value);
        }
    }

    /**
     * @return array
     */
    private function getDefaultInfo()
    {
        $info = [
            'csrf' => $this->session->getToken(),
            'services' => [

            ],
        ];

        if ($this->auth->check()) {
            $info['auth'] = [
                'jwt' => $this->jwt->byUser($this->auth->user()),
                'user' => [
                    'id' => $this->auth->user()->id(),
                ],
            ];

            if ($this->auth->checkTeam()) {
                $info['auth']['team'] = [
                    'id' => $this->auth->team()->id(),
                ];
                $info['auth']['account'] = (new AccountTransformer())->transform($this->auth->account());
            }
        }

        return $info;
    }

    /**
     * Convert the object to its JSON representation.
     *
     * @param  int $options
     * @return string
     */
    public function toJson($options = 0)
    {
        return json_encode($this->get(), $options);
    }
}

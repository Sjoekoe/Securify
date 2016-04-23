<?php
namespace App\Keys;

use App\Http\AbstractRouteBinding;
use App\Http\RouteBinding;

class KeyRouteBinding extends AbstractRouteBinding implements RouteBinding
{
    /**
     * @var \App\Keys\KeyRepository
     */
    private $keys;

    public function __construct(KeyRepository $keys)
    {
        $this->keys = $keys;
    }

    /**
     * @param int $id
     * @return \App\Keys\Key|null
     */
    public function find($id)
    {
        return $this->keys->find($id);
    }
}

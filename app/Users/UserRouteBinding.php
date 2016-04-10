<?php
namespace App\Users;

use App\Http\AbstractRouteBinding;
use App\Http\RouteBinding;

class UserRouteBinding extends AbstractRouteBinding implements RouteBinding
{
    /**
     * @var \App\Users\UserRepository
     */
    private $users;

    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }

    /**
     * @param int|string $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->users->find($id);
    }
}

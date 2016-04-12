<?php
namespace App\JWT;

use App\Users\User;

interface TokenGenerator
{
    /**
     * @param \App\Users\User $user
     * @return string
     */
    public function byUser(User $user);
}

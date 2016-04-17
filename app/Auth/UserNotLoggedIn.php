<?php
namespace App\Auth;

use Illuminate\Http\Exception\HttpResponseException;

class UserNotLoggedIn extends HttpResponseException
{
    public function __construct()
    {
        $this->response = redirect()->route('login');
    }
}

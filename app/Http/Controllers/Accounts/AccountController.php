<?php
namespace App\Http\Controllers\Accounts;

use App\Http\Controllers\Controller;

class AccountController extends Controller
{
    /**
     * AccountController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('accounts.index');
    }
}

<?php
namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('users.settings.index');
    }
}

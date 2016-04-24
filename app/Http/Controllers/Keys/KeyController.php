<?php
namespace App\Http\Controllers\Keys;

use App\Http\Controllers\Controller;

class KeyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('keys.index');
    }
    
    public function create()
    {
        return view('keys.create');
    }
}

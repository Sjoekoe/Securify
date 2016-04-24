<?php
namespace App\Http\Controllers\Keys;

use App\Core\Info\Info;
use App\Http\Controllers\Controller;
use App\Keys\Key;

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
    
    public function edit(Info $info, Key $key)
    {
        $info->flash('key', $key->id());
        
        return view('keys.edit');
    }
}

<?php
namespace App\Http\Controllers\Visitors;

use App\Http\Controllers\Controller;

class VisitorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        return view('visitors.index');
    }
}

<?php
namespace App\Http\Controllers\Visitors;

use App\Core\Info\Info;
use App\Http\Controllers\Controller;
use App\Visits\Visit;

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

    public function create()
    {
        return view('visitors.create');
    }

    public function edit(Info $info, Visit $visit)
    {
        $info->flash('visit', $visit->id());
        
        return view('visitors.edit');
    }
}

<?php
namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;

class PagesController extends Controller
{
    public function home()
    {
        return view('pages.home');
    }
}

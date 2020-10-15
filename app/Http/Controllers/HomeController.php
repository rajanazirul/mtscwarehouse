<?php

namespace App\Http\Controllers;
use Carbon\Carbon;


class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */

    public function index()
    {
       
        
        return view('dashboard');
    }

    
    
}

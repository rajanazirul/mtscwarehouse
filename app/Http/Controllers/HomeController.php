<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Dmaddreturn;
use App\Dmform;


class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */

    public function index()
    {
       
        return view('dashboard', [
            
            'dmaddreturns'           => Dmaddreturn::latest()->limit(20)->get(),
            'dmforms'           => Dmform::latest()->limit(20)->get()
            
        ]);
        
    }

    
    
}

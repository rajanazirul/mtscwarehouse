<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dmaddreturn;
use App\Dmform;

class DashboardController extends Controller
{
    public function getStatus(Request $request){
        return Dmaddreturn::paginate(5);
    }

    public function getDeduct(Request $request){
        return Dmform::paginate(5);
    }
    
    public function searchDmform(Request $request)
    {
    	$key = $request->id;
        $unit = Dmform::where('id','LIKE',"%{$key}%")
                                    ->get();

    	return response()->json($unit);
    }

    public function searchAddreturn(Request $request)
    {
    	$key = $request->id;
        $unit = Dmaddreturn::where('id','LIKE',"%{$key}%")
                                    ->get();

    	return response()->json($unit);
    }

}

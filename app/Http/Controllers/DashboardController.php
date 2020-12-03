<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dmaddreturn;
use App\Dmform;

class DashboardController extends Controller
{
    public function getStatus(Request $request){
        return Dmaddreturn::all();
    }

    public function editStatus(Request $request)
    {
        // validate request
        $this->validate($request, [
            'status' => 'required',
            'id' => 'required',
        ]);
        return Dmaddreturn::where('id', $request->id)->update([
            'status' => $request->status,
        ]);
    }

    public function getDeduct(Request $request){
        return Dmform::all();
    }

    public function editDeduct(Request $request)
    {
        // validate request
        $this->validate($request, [
            'status' => 'required',
            'id' => 'required',
        ]);
        return Dmform::where('id', $request->id)->update([
            'status' => $request->status,
        ]);
    }
    
}

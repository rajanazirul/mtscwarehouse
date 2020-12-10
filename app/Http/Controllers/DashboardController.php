<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
use App\Dmaddreturn;

class DashboardController extends Controller
{
    public function DashboardView(){

        return respond()->json([
            'msg' => 'Succes'
        ]);
    }

    public function addStatus(Request $request){
        return Tag::create([
            'status' => $request->status
        ]);
    }

    public function getStatus(){
        return Dmaddreturn::all();
    }

    public function editTag(Request $request)
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
    
}

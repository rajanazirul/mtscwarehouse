<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dmaddreturn;
use App\Dmform;
<<<<<<< HEAD
use App\TakenProduct;
use App\Product;
=======
>>>>>>> parent of 01f98db... Merge branch 'test_vue' into main

class DashboardController extends Controller
{
    public function getStatus(Request $request){
<<<<<<< HEAD
        return Dmaddreturn::orderByDesc('id')->paginate(10);
=======
        return Dmaddreturn::all();
>>>>>>> parent of 01f98db... Merge branch 'test_vue' into main
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
<<<<<<< HEAD
        
        /*$dmform = Dmform::orderByDesc('id')->paginate(10);
        $dmform_id = Dmform::orderByDesc('id')->paginate(10)->get();
        $product = TakenProduct::where('id', '1')
        ->get();
        $result = array();
        $result['dmform'] = $dmform;
        $result['dmform']['product']= $product;
        return response()->json($result);*/
        return Dmform::orderByDesc('id')->paginate(10);
=======
        return Dmform::all();
>>>>>>> parent of 01f98db... Merge branch 'test_vue' into main
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

    public function getProduct(Request $request){
        return Product::orderByDesc('id')->paginate(10);
    }

    public function searchProduct(Request $request)
    {
    	$key = $request->id;
        $unit = Product::where('description','LIKE',"%{$key}%")
            ->get();

    	return response()->json($unit);
    }

    public function searchPart(Request $request)
    {
    	$key = $request->part;
        $unit = Product::where('name','LIKE',"%{$key}%")
            ->get();

    	return response()->json($unit);
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

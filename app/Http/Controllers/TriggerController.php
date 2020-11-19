<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Trigger;

class TriggerController extends Controller
{
    //
    public function triggerUpdate($id)
    {
        $trigger = Trigger::where('id', $id)->update(['value' => 0]);
        
        return response()->json([
            'value' => $trigger
            ], 200);
    }
    
    public function triggerUpdateOn($id)
    {
        $trigger = Trigger::where('id', $id)->update(['value' => 1]);
        
        return response()->json([
            'value' => $trigger
            ], 200);
    }
}
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AddCustomerar extends Model
{
     //this is for deduct/returns customer dm form
     protected $fillable = [
        'dmaddreturn_id', 'customer_id'
    ];
    
    public function customer()
    {
        return $this->belongsTo('App\Customer');
    }
    public function dmaddreturn()
    {
        return $this->belongsTo('App\Dmaddreturn');
    }
}

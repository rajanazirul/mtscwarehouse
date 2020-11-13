<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AddCustomer extends Model
{
    //this is for deduct/returns customer dm form
    protected $fillable = [
        'dmform_id', 'customer_id'
    ];
    
    public function customer()
    {
        return $this->belongsTo('App\Customer');
    }
    public function dmform()
    {
        return $this->belongsTo('App\Dmform');
    }

   

    
}

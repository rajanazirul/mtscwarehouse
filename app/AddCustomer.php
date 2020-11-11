<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AddCustomer extends Model
{
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

    public function dmaddreturn()
    {
        return $this->belongsTo('App\Dmaddreturn');
    }

    
}

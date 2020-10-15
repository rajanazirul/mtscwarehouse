<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TakenProduct extends Model
{
    protected $fillable = [
        'onsite_id', 'product_id', 'qty'
    ];
    
    public function product()
    {
        return $this->belongsTo('App\Product');
    }
    public function onsite()
    {
        return $this->belongsTo('App\Onsite');
    }
}

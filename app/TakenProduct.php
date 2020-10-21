<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TakenProduct extends Model
{
    protected $fillable = [
        'dmform_id', 'product_id', 'qty'
    ];
    
    public function product()
    {
        return $this->belongsTo('App\Product');
    }
    public function dmform()
    {
        return $this->belongsTo('App\Dmform');
    }
}

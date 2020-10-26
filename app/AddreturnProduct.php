<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AddreturnProduct extends Model
{
    protected $fillable = [
        'dmaddreturn_id', 'product_id', 'stock'
    ];

    public function dmaddreturn()
    {
        return $this->belongsTo('App\Dmaddreturn');
    }

    public function product()
    {
        return $this->belongsTo('App\Product');
    }
}

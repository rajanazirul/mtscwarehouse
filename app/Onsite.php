<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Onsite extends Model
{
    protected $fillable = [
        'customer_id', 'user_id'
    ];
    public function customer() {
        return $this->belongsTo('App\Customer');
    }
  
    public function products() {
        return $this->hasMany('App\Takenproduct');
    }
    public function user() {
        return $this->belongsTo('App\User');
    }
}

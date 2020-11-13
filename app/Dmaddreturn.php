<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dmaddreturn extends Model
{
    protected $fillable = [
        'purpose_id', 'user_id', 'dono', 'invno','customer_id'
    ];

    public function purpose() {
        return $this->belongsTo('App\Purpose');
    }
    
    public function products() {
        return $this->hasMany('App\AddreturnProduct');
    }
    public function user() {
        return $this->belongsTo('App\User');
    }

    public function customer() {
        return $this->belongsTo('App\Customer');
    }


}

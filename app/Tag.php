<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //
    protected $fillable = ['status', 'dmaddreturn_id'];

    public function dmaddreturn()
    {
        return $this->belongsTo('App\Dmaddreturn');
    }
    
}

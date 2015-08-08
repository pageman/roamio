<?php namespace App;

use Eloquent;
use Entry;

class Tag extends Eloquent{
    
    protected $hidden = ['updated_at','created_at','entry_id'];

    public function entry() 
    {
        return $this->belongsTo('App\Entry');
    }
}

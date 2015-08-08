<?php namespace App;

use Eloquent;

class BeastCollection extends Eloquent{
    $table = "collections";

    protected $hidden = ['updated_at','created_at'];
    public function load()
    {
        return $this->hasMany('CollectionLoad');
    }

}

<?php namespace App;

use Eloquent;

class CollectionLoad extends Eloquent{
    $table = "collection_load";
    protected $hidden = ['updated_at','created_at'];

    public function collection()
    {
        return $this->belongsTo('BeastCollection','collection_id',);
    }

    public function entries()
    {
        return $this->hasMany('Entry');
    }
}

<?php namespace App;

use Eloquent;

class Entry extends Eloquent {
    protected $table = "entries";
    protected $hidden = ['updated_at','created_at'];

    public function locations(){
        return $this->hasMany('App\Location');
    }

    public function participants(){
        return $this->hasMany('App\Participant');
    }

    public function tags() 
    {
        return $this->hasMany('App\Tag');
    }

    public function days()
    {
        return $this->hasMany('App\BeastDay');
    }

    public function hours()
    {
        return $this->hasMany('App\BeastHours');
    }
}

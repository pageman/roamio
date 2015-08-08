<?php namespace App;

use Eloquent;

class Location extends Eloquent{
    protected $hidden = ['updated_at','created_at','entry_id'];

}

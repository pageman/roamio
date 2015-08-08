<?php namespace App;

use Eloquent;

class BeastDay extends Eloquent{
    protected $table = 'days';     
    protected $hidden = ['updated_at','created_at','entry_id'];

}

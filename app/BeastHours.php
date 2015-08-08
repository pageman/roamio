<?php namespace App;

use Eloquent;

class BeastHours extends Eloquent{
    protected $table = "hours";
    protected $hidden = ['updated_at','created_at','entry_id'];

}

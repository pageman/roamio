<?php namespace App;

use Eloquent;

class Category extends Eloquent{
    $table = "categories";
    protected $hidden = ['updated_at','created_at','entry_id'];

}

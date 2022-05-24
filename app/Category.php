<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps = false;

    //relazione con tabella posts
    public function posts() {
        return $this->hasMany('App/Post');
    }
}

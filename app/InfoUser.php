<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InfoUser extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'address', 'phone', 'birth',
    ];

    public function user() {
        return $this->belongsTo('App/User');
    }
}

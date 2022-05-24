<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Str;

class Post extends Model
{

    //If you would like model binding to use a default database column other than id when retrieving a given model class
    public function getRouteKeyName() {
        return 'slug';
    }


    protected $fillable = [
        'title',
        'content',
        'slug',
        'user_id',
        'category_id'
    ];

    //metodo per generare slug unico da stringa
    static public function generateSlug($fromThisStr) {
        $baseSlug = Str::slug($fromThisStr, '-');
        $slug = $baseSlug;
        $i = 1;

        while (self::where('slug', $slug)->first()) {
            $slug = "$baseSlug-$i";
            $i++;
        }
        return $slug;
    }

    //metodo per validare slug scelto dall'utente
    static public function validateSlug($strSlug) {
        $baseSlug = $strSlug;
        $slug = $baseSlug;
        $i = 1;
        if (strpos($slug, ' ')) {
            $slug = str_replace(' ', '-', $slug);
        }
        while (self::where('slug', $slug)->first()) {
            $slug = "$baseSlug-$i";
            $i++;
        }
        return $slug;
    }

    //relazioni tabelle db
    public function user() {
        return $this->belongsTo('App\User');
    }

    public function category() {
        return $this->belongsTo('App\Category');
    }

    public function tags() {
        return $this->belongsToMany('App\Tag');
    }
}

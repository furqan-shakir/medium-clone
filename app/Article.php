<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    public function photos()
    {
        return $this->hasMany('App\ArticlePhoto');
    }

    public function tags()
    {
        return $this->morphToMany('App\Tag', 'taggable');
    }
}

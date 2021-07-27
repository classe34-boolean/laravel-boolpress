<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * Relazioni
     */
    // categories - posts
    public function posts() {
        return $this->hasMany('App\Post');
    }
}

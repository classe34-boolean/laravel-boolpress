<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'content',
        'cover'
    ];

    // EAGER LOADING su tutte le query
    // protected $with = [
    //     'category',
    //     'tags'
    // ];

    /**
     * Relazioni
     */
    // posts - categories
    public function category() {
        return $this->belongsTo('App\Category');
    }

    // posts - tags
    public function tags() {
        return $this->belongsToMany('App\Tag');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'content'
    ];

    /**
     * Relazioni
     */
    // posts - categories
    public function category() {
        return $this->belongsTo('App\Category');
    }
}

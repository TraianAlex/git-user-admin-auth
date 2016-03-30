<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function categories()
    {
    	return $this->belongsToMany(Category::class, 'posts_categories');
    }

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function posts()
    {
    	return $this->hasMany(Post::class);
    }

    public function category()
    {
    	return $this->belongsTo(Category::class);
    }

    public static function unapprovedCount()
    {
        return static::where('approved', 0)->count();
    }
}

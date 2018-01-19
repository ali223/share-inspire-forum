<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    
    protected $fillable = ['title', 'user_id'];

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

    public static function getLatestTopics()
    {
        return static::with('user')->latest()->take(5)->get();
    }

    public function addPost($content, $userId)
    {
        return $this->posts()->create([
            'content' => $content,
            'user_id' => $userId
        ]);
    }


}

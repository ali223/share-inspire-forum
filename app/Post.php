<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    protected $fillable = ['content', 'user_id'];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function topic()
    {
    	return $this->belongsTo(Topic::class);
    }

    public function scopeBelongingToApprovedTopic($query) 
    {
        return $query->whereHas('topic', function($topicQuery) {
            $topicQuery->where('approved', 1);
        });
    }

    public function scopeSearchContent($query, $keywords = [])
    {
        return $query->where(function($subQuery) use ($keywords) {
            foreach($keywords as $keyword) {
                $subQuery->orWhere('content', 'like', "%{$keyword}%");
            }
        });
    }

    public static function unapprovedCount()
    {
        return static::where('approved', 0)->count();
    }
    
}

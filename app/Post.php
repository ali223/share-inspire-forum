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

    public function scopeWithTopicApproved($query) 
    {
        $query->whereHas('topic', 
                        function($query) {
                            $query->where('approved', 1);
                        });
    }

    public function scopeSearchContent($query, $keywords = [])
    {
        $query->where( function($query) use ($keywords) {
            foreach($keywords as $keyword) {
                $query->orWhere('content', 'like', "%{$keyword}%");
            }
        });
    }

    public static function unapprovedCount()
    {
        return static::where('approved', 0)->count();
    }
    
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['content', 'user_id'];

    protected $appends = ['is_liked', 'likes_count'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    public function getIsLikedAttribute()
    {
        return (bool) $this->likes->where('user_id', auth()->id())->count();
    }

    public function scopeBelongingToApprovedTopic($query)
    {
        return $query->whereHas('topic', function ($topicQuery) {
            $topicQuery->where('approved', 1);
        });
    }

    public static function unapprovedCount()
    {
        return static::where('approved', 0)->count();
    }

    public function markAsLikedBy($userId)
    {
        $this->likes()->create([
            'user_id' => $userId
        ]);
    }

    public function markAsUnlikedBy($userId)
    {
        $this->likes()
            ->where('user_id', $userId)
            ->delete();
    }

    public function getLikesCountAttribute()
    {
        return $this->likes()->count();
    }

    public static function getPostsLikedByUser($userId)
    {
        return static::whereHas('likes', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->get();
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'description', 'admin_id'];

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function topics()
    {
        return $this->hasMany(Topic::class);
    }

    public function posts()
    {
        return $this->hasManyThrough(Post::class, Topic::class);
    }

    public function addTopic($title, $content, $userId)
    {
        $topic = $this->topics()->create([
            'title' => $title,
            'user_id' => $userId
        ]);

        $topic->posts()->create([
            'content' => $content,
            'user_id' => $userId
        ]);

        return $topic;
    }

    public static function getCategoriesWithTopicsCount()
    {
        return static::withCount([
                'topics' => function ($query) {
                    $query->where('approved', 1)
                        ->orWhere('user_id', auth()->id());
                }
            ])->get();
    }

    public function loadApprovedTopicsAndAllByUser($userId = null)
    {
        $this->load([
            'topics' => function ($query) use ($userId) {
                $query->where('approved', 1);
                if ($userId) {
                    $query->orWhere('user_id', $userId);
                }
            }
        ]);
    }
}

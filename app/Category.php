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
}

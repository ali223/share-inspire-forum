<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    protected $fillable = ['text', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

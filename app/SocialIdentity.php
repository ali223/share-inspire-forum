<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocialIdentity extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function findByProviderNameAndProviderUserId($providerName, $providerUserId)
    {
        return static::where('provider_name', $providerName)
                    ->where('provider_user_id', $providerUserId)
                    ->first();
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocialAccount extends Model
{
    protected $fillable = ['user_id', 'provider_user_id', 'provider'];

    public function user()
    {
        return $this->belongsTo("App\User");
    }

    public function getAvatar()
    {
        return 'http://graph.facebook.com/'.$this->provider_user_id.'/picture';
    }
}

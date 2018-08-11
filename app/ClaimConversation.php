<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClaimConversation extends Model
{
    protected $fillable = ['claim_id', 'user_id', 'conversation'];

    public function files()
    {
        return $this->hasMany(ClaimConversationFiles::class, 'claim_conversation_id', 'id');
    }

    public function getCreatedAtAttribute($value)
    {
        if ($value) {
            return date('Y-m-d', strtotime($value));
        }
        return $value;
    }
}

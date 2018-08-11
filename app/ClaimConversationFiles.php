<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClaimConversationFiles extends Model
{
    protected $fillable = ['claim_id', 'file_name'];
}

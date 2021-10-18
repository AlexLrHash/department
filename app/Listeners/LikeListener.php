<?php

namespace App\Listeners;

use App\Models\Like;
use LikeService;

class LikeListener
{
    public function creating(Like $like)
    {
        $like->second_id = LikeService::generateSecondId();
    }
}

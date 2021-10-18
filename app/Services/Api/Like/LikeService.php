<?php

namespace App\Services\Api\Like;

use App\Models\Like;

class LikeService
{
    /**
     * Generate second id for discipline
     *
     * @return int
     */
    public function generateSecondId()
    {
        $exists = true;
        while ($exists) {
            $second_id = mt_rand(10000000, 99999999);
            $exists = Like::where('second_id', $second_id)->exists();
        }

        return $second_id;
    }
}

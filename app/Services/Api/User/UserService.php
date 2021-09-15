<?php

namespace App\Services\Api\User;

use App\Models\User;

class UserService
{
    /**
     * Generate second id for user
     *
     * @return int
     */
    public function generateSecondId()
    {
        $exists = true;
        while ($exists) {
            $second_id = mt_rand(10000000, 99999999);
            $exists = User::where('second_id', $second_id)->exists();
        }

        return $second_id;
    }
}

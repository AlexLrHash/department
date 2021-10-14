<?php

namespace App\Http\Controllers\Api\Like;

use App\Classes\Enum\Api\Like\LikeTypeEnum;
use App\Classes\Enum\Api\Like\LikeValueEnum;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Like\LikeResource;
use App\Models\Like;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    /**
     * Поставление лайка
     *
     * @param Request $request
     * @param $teacherSecondId
     * @return mixed
     */
    public function teacherLike(Request $request, $teacherSecondId)
    {
        $foreignId = User::teachers()->where('second_id', $teacherSecondId)->firstOrFail()->id;

        if (Like::where('user_id', Auth::id())
                ->where('foreign_id', $foreignId)
                ->exists())
        {
            abort(422, 'Вы уже оценили пользователя');
        }

        $like = Like::create([
            'type' => LikeTypeEnum::TEACHER,
            'user_id' => Auth::id(),
            'foreign_id' => $foreignId,
            'value' => LikeValueEnum::LIKE
        ]);

        return LikeResource::make($like);
    }
}

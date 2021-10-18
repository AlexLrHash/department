<?php

namespace App\Http\Controllers\Api\User;

use App\Classes\Enum\Api\User\Param\Student\StudentParamNameEnum;
use App\Classes\Enum\Api\User\Param\Student\StudentParamTypeEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\Student\UpdateStudentParamRequest;
use App\Http\Resources\Api\User\ParamResource;
use App\Http\Resources\Api\User\Student\StudentParamResource;
use App\Models\UserParam;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    /**
     * Изменение параметров
     *
     * @param UpdateStudentParamRequest $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     * @throws \ReflectionException
     */
    public function updateParams(UpdateStudentParamRequest $request)
    {
        $params = $request->get('params');
        $currentUserId = Auth::id();
        $userParamCollection = new Collection();

        foreach ($params as $param) {
            $userParam = UserParam::where('user_id', $currentUserId)->where('name', Arr::get($param, 'name'))->first();

            if(!$userParam) {
                $userParam = new UserParam();
            }
            $userParam->fill([
                'name' => Arr::get($param, 'name'),
                'value' => Arr::get($param, 'value'),
                'type' => StudentParamTypeEnum::lists()[Arr::get($param, 'name')],
                'user_id' => $currentUserId
            ]);
            $userParam->save();

            $userParamCollection = $userParamCollection->merge([$userParam]);
        }

        return StudentParamResource::collection($userParamCollection);
    }

    /**
     * Получение параметров
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getParams()
    {
        $userParams = UserParam::where('user_id', Auth::id())->get();

        return StudentParamResource::collection($userParams);
    }
}

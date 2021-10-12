<?php

namespace App\Http\Controllers\Api\Department;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Department\DepartmentResource;
use App\Models\Department;

class DepartmentController extends Controller
{
    /**
     * Получение всех отделений
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return DepartmentResource::collection(Department::get());
    }

    /**
     * Получаем отделение по secondId
     *
     * @param $departmentSecondId
     * @return DepartmentResource
     */
    public function show($departmentSecondId)
    {
        return DepartmentResource::make(Department::where('second_id', $departmentSecondId)->firstOrFail());
    }
}

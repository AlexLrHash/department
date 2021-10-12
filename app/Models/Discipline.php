<?php

namespace App\Models;

use App\Classes\Enum\Api\User\UserRoleEnum;
use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discipline extends Model
{
    use HasFactory, Filterable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'department_id',
        'description',
        'background'
    ];

    /**
     * Получение преподователей дисциплины
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function teachers() {
        return $this->belongsToMany(User::class, 'teacher_discipline', 'discipline_id', 'teacher_id')->where('role', UserRoleEnum::TEACHER);
    }
}

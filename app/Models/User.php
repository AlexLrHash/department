<?php

namespace App\Models;

use App\Classes\Enum\Api\Like\LikeValueEnum;
use App\Classes\Enum\Api\User\UserRoleEnum;
use App\Models\Traits\Filterable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Filterable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'role',
        'password',
        'status',
        'avatar',
        'phone',
        'verify_token',
        'is_consent_privacy_policy',
        'is_consent_terms_of_use'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Получение дисцилин
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function disciplines()
    {
        return $this->belongsToMany(Discipline::class, 'teacher_discipline', 'teacher_id', 'discipline_id')->withPivot(['number_of_practices', 'number_of_labs']);
    }

    /**
     * Получение количесвта часов
     *
     * @return array
     */
    public function commonNumberOfWork()
    {
        $commonNumberOfLabs = 0;
        $commonNumberOfPractices = 0;

        $userDisciplines = $this->disciplines;

        foreach ($userDisciplines as $discipline) {
            $commonNumberOfLabs += $discipline->pivot->number_of_labs;
            $commonNumberOfPractices += $discipline->pivot->number_of_practices;
        }

        return [
            'common_number_of_practices' => $commonNumberOfPractices,
            'common_number_of_labs' => $commonNumberOfLabs
        ];
    }

    /**
     * Получение преподавателей
     *
     * @param Builder $builder
     */
    public function scopeTeachers(Builder $builder)
    {
        $builder->where('role', UserRoleEnum::TEACHER);
    }

    /**
     * Получение мэнеджеров
     *
     * @param Builder $builder
     */
    public function scopeManagers(Builder $builder)
    {
        $builder->where('role', UserRoleEnum::MANAGER);
    }

    /**
     *  Получение количества лайков
     *
     * @return int
     */
    public function getCountLikesAttribute() : int
    {
        return count($this->likes);
    }

    /**
     * Лайки
     *
     * @return BelongsToMany
     */
    public function likes() : BelongsToMany
    {
        return $this->belongsToMany(User::class, 'likes', 'foreign_id', 'user_id')->where('value', LikeValueEnum::LIKE);
    }

    /**
     * Получение отделения
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function department()
    {
        return $this->hasOne(Department::class, 'manager_id', 'id');
    }

    /**
     * Получение груп преподавателя
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function getTeacherGroups()
    {
        return $this->hasMany(TeacherGroup::class, 'teacher_id', 'id');
    }

    public function getStudentGroups()
    {
        return $this->belongsToMany(TeacherGroup::class, 'student_group', 'student_id', 'group_id');
    }

    /**
     * Получение параметров
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function params()
    {
        return $this->hasMany(UserParam::class, 'user_id', 'id');
    }
}

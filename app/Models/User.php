<?php

namespace App\Models;

use App\Classes\Enum\Api\User\UserRoleEnum;
use App\Models\Traits\Filterable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
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
        'department_id',
        'status',
        'avatar',
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
     * Получение департамента
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }

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
     * Получение аватара
     *
     * @param $userAvatar
     * @return string
     * TODO Change logic
     */
    public function getAvatarAttribute($userAvatar)
    {
        if (strpos($userAvatar, 'https')) {
            $avatarUrl = config("app.url") . '/storage/';

            $userAvatar = str_replace('public/', '', $userAvatar);

            return $userAvatar ? $avatarUrl . $userAvatar : $avatarUrl . 'avatars/users/default.jpg';
        }

        return $userAvatar;
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
     * Teachers
     *
     * @param Builder $builder
     */
    public function scopeTeachers(Builder $builder)
    {
        $builder->where('role', UserRoleEnum::TEACHER);
    }
}

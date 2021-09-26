<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'department_id',
        'status',
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
        return $this->belongsToMany(Discipline::class, 'teacher_discipline', 'teacher_id', 'discipline_id');
    }

    /**
     * Получение аватара
     *
     * @param $userAvatar
     * @return string
     */
    public function getAvatarAttribute($userAvatar)
    {
        $avatarUrl = config("app.url") . '/storage/';

        $userAvatar = str_replace('public/', '', $userAvatar);

        return $userAvatar ? $avatarUrl . $userAvatar : $avatarUrl . 'default.jpg';
    }
}

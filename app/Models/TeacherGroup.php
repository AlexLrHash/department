<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherGroup extends Model
{
    use HasFactory;

    protected $table = 'teacher_groups';

    protected $fillable = [
        'name',
        'description',
        'teacher_id',
        'discipline_id'
    ];

    /**
     * Получение преподавателя
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id', 'id');
    }

    /**
     * Студенты
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function students()
    {
        return $this->belongsToMany(User::class, 'student_group', 'group_id', 'student_id');
    }

    /**
     * Задания группы
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tasks()
    {
        return $this->hasMany(GroupTask::class, 'group_id', 'id');
    }

    /**
     * Получение дисциплины
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function discipline()
    {
        return $this->belongsTo(Discipline::class, 'discipline_id', 'id');
    }
}

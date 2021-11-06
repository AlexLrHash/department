<?php

namespace App\Models;

use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory, Filterable;

    /**
     * Поля для заполнения через метод create.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'manager_id',
        'description'
    ];

    /**
     * Получение мэнеджера
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id', 'id');
    }

    /**
     * Получение дисциплины
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function disciplines()
    {
        return $this->hasMany(Discipline::class, 'department_id', 'id');
    }

    /**
     * Получение преподавателей
     *
     * @return Collection
     */
    public function getTeachers()
    {
        $teacherCollection = new Collection();
        foreach ($this->disciplines as $discipline) {
            foreach ($discipline->teachers as $teacher) {
                if (!$teacherCollection->contains($teacher->id)) {
                    $teacherCollection = $teacherCollection->merge([$teacher]);
                }
            }
        }

        return $teacherCollection;
    }
}

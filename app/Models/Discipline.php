<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discipline extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'number_of_labs',
        'number_of_practices'
    ];

    /**
     * Getting teachers of discipline
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function teachers() {
        return $this->belongsToMany(User::class, 'teacher_discipline', 'discipline_id', 'teacher_id');
    }
}

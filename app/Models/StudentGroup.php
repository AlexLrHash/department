<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentGroup extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'student_group';

    protected $fillable = [
        'student_id',
        'teacher_id'
    ];
}

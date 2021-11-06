<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupTask extends Model
{
    use HasFactory;

    protected $table = 'group_tasks';

    protected $fillable = [
        'name',
        'description',
        'group_id',
        'expired_at'
    ];
}

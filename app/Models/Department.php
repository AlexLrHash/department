<?php

namespace App\Models;

use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory, Filterable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'manager_id'
    ];

    /**
     * Getting manager
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id', 'id');
    }

    public function getBackgroundAttribute($departmentBackground)
    {
        $departmentBackgroundUrl = config('app.url') . '/storage/';

        $departmentBackground = str_replace('public/', '', $departmentBackground);

        return $departmentBackground ? $departmentBackgroundUrl . $departmentBackground : $departmentBackgroundUrl . 'backgrounds/departments/default.jpg';
    }
}

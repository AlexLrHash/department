<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserParam extends Model
{
    use HasFactory;

    protected $fillable = [
        'value',
        'user_id',
        'name',
        'type',
        'is_active'
    ];

    /**
     * Получение пользователя
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}

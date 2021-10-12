<?php

namespace App\Models;

use App\Models\Traits\Filterable;
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
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Like extends Model
{
    use HasFactory;

    /** @var string[]  */
    protected $fillable = [
        'type',
        'user_id',
        'foreign_id',
        'value'
    ];

    /**
     * Получение текущего юзера
     *
     * @return BelongsTo
     */
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Получение преподавателя
     *
     * @return BelongsToMany
     */
//    public function teachers() : BelongsToMany
//    {
//        return $this->belongsToMany(User::class, 'likes', 'user_id', 'foreign_id');
//    }

    /**
     * Получение юзера которого лайкнули
     *
     * @return BelongsTo
     */
    public function foreign()
    {
        return $this->belongsTo(User::class, 'foreign_id', 'id');
    }

}

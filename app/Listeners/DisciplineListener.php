<?php

namespace App\Listeners;

use App\Models\Discipline;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use DisciplineService;

class DisciplineListener
{
    /**
     * Создание дисциплины
     *
     * @param Discipline $discipline
     */
    public function creating(Discipline $discipline)
    {
        $discipline->second_id = DisciplineService::generateSecondId();
    }
}

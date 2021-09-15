<?php

namespace App\Listeners;

use App\Models\Discipline;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use DisciplineService;

class DisciplineListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        //
    }

    /**
     * Creating Discipline
     *
     * @param Discipline $discipline
     */
    public function creating(Discipline $discipline)
    {
        $discipline->second_id = DisciplineService::generateSecondId();
    }
}

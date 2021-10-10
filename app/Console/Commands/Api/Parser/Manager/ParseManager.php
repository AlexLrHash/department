<?php

namespace App\Console\Commands\Api\Parser\Manager;

use App\Classes\Enum\Api\Manager\ManagerParserUrl;
use App\Services\Api\Manager\ManagerService;
use App\Services\Api\Teacher\TeacherService;
use Illuminate\Console\Command;

class ParseManager extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'manager:parse';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Парсинг заведующих отделений';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $managerService = app(ManagerService::class);

        foreach (ManagerParserUrl::lists() as $url ) {
            $managerService->parse($url);
        }
    }
}

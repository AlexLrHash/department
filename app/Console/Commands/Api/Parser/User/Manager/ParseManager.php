<?php

namespace App\Console\Commands\Api\Parser\User\Manager;

use App\Classes\Enum\Api\User\Manager\ManagerParserUrl;
use App\Facades\Manager;
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
        foreach (ManagerParserUrl::lists() as $url ) {
            Manager::parse($url);
        }
    }
}

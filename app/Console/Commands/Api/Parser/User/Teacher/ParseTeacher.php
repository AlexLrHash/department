<?php

namespace App\Console\Commands\Api\Parser\User\Teacher;

use App\Classes\Enum\Api\User\Teacher\TeacherParserUrl;
use Illuminate\Console\Command;
use App\Facades\Teacher;

class ParseTeacher extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'teacher:parse';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Парсинг преподавателей';

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
        foreach (TeacherParserUrl::lists() as $url ) {
            Teacher::parse($url);
        }
    }
}

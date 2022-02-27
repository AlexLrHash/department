<?php

namespace App\Jobs;

use App\Mail\AddStudentEmail;
use App\Mail\CreateTaskEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmailCreateTaskJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $userEmail;

    protected $groupName;

    protected $teacherName;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($userEmail, $groupName, $teacherName)
    {
        $this->userEmail = $userEmail;
        $this->groupName = $groupName;
        $this->teacherName = $teacherName;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if ($this->userEmail) {
            Mail::to($this->userEmail)->send(new CreateTaskEmail($this->teacherName, $this->groupName));
        }
    }
}

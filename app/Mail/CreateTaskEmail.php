<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CreateTaskEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $teacherName;

    protected $groupName;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($teacherName, $groupName)
    {
        $this->teacherName = $teacherName;
        $this->groupName = $groupName;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.groups.create_task', ['teacherName' => $this->teacherName, 'groupName' => $this->groupName]);
    }
}

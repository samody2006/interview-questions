<?php

namespace App\Mail;

use App\Models\Schedule;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ScheduleNotification extends Mailable
{
    use Queueable, SerializesModels;
    public Schedule $schedule;
    public $action;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Schedule $schedule, $action)
    {
        $this->schedule = $schedule;
        $this->action = $action;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("Irrigation Schedule {$this->action}")
            ->markdown('emails.schedule-notification', [
                'schedule' => $this->schedule,
                'action' => $this->action,
                'zoneName' => $this->schedule->zone->name
            ]);
    }
}

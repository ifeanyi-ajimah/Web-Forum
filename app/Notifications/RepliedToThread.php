<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Carbon;

class RepliedToThread extends Notification
{
    use Queueable;

    protected $thread;
    protected $commentor;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($thread, $commentor)
    {
        $this->thread = $thread;
        $this->commentor = $commentor;
    }




    public function via($notifiable)
    {
        return ['database'];
    }


    public function toDatabase($notifiable)
    {

        return [
            //'repliedTime' => Carbon::now()
            'commentor' => $this->commentor,
            'thread' => $this->thread,
            'user' => $notifiable,
        ];
    }



    // public function toMail($notifiable)
    // {
    //     return (new MailMessage)
    //                 ->line('The introduction to the notification.')
    //                 ->action('Notification Action', url('/'))
    //                 ->line('Thank you for using our application!');
    // }



    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}

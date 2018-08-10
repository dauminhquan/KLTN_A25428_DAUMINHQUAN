<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NotifyEvent extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    private  $event;
    public function __construct(array $event)
    {
        $this->event = $event;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail','broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        if($this->event['log'] == true)
        {
            $title = 'Có sự kiện mới từ nhà trường';
            if(isset($this->event->titile))
            {
                $title = $this->event->titile;
            }
            $url = '/';
            if(isset($this->event->id))
            {
                $url = route('web.events.id' ,['id' => $this->event->id]);
            }

            return (new MailMessage)
                ->line($title)
                ->action('Xem chi tiết', $url)
                ->line('Hãy ghé thăm bạn nhé!');
        }
    }
    public function toBroadcast()
    {
        return $this->event;
    }
    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'text' => 'hello'
        ];
    }


}

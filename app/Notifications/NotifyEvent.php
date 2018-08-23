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
    public function via()
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
            $title = 'Có sự kiện mới từ nhà trường';
            if(isset($this->event['title']))
            {
                $title = $this->event['title'];
            }
            $url = '/';
            if(isset($this->event['id']))
            {
                $url = route('web.events.info' ,['id' => $this->event['id']]);
            }
        $description = '';
        if(isset($this->event['id']))
        {
            $description = $this->event['description'];
        }
            return (new MailMessage)
                ->line($title)
                ->action('Xem chi tiết', $url)
                ->line($description)
                ->subject('Thông báo sự kiện mới');
    }

}

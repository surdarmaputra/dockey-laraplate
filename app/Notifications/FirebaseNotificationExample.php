<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

use App\ThirdParties\Firebase\FirebasePushNotification;
use App\Notifications\Channels\Firebase;

class FirebasePushNotif extends Notification
{
    use Queueable;

    protected $title;
    protected $body;
    protected $data;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($title = '', $body = '', $label = '', $data = [])
    {
        $this->title = $title;
        $this->body = $body;
        $this->data = (is_array($data)) ? $data : [];
        $this->data['label'] = $label; //label to determine notification feature
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', Firebase::class];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
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
            'channel' => 'Firebase Cloud Messaging',
            'to' => $notifiable->token_firebase,
            'notification' => [
                'title' => $this->title,
                'body' => $this->body,
            ],
            'data' => $this->data,
        ];
    }

    /**
     * Get the FirebasePushNotification object representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toFirebase($notifiable)
    {
        return new FirebasePushNotification($notifiable->token_firebase, $this->title, $this->body, $this->data);
    }
}


<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
class CreatePost extends Notification
{
    use Queueable;

    private $post_id;
    private $user_name;
    private $title;
    /**
     * Create a new notification instance.
     */
    public function __construct($post_id, $user_name , $title)
    {
        $this->post_id = $post_id;
        $this->user_name = Auth::user()->name;
        $this->title = $title;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'post_id' => $this->post_id,
            'user_name' => Auth::user()->name,
            'title' => $this->title
            
        ];
    }
}

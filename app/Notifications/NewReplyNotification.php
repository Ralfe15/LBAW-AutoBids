<?php

namespace App\Notifications;

use App\Models\Auction;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewReplyNotification extends Notification
{
    use Queueable;
    public Auction $auc;


    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Auction $auc)
    {
        $this->auc = $auc;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
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
            'auction_name' => $this->auc->id. ": " . $this->auc->model->brand->name. " - " .
                $this->auc->model->name . " - "  . $this->auc->year,
        ];
    }
}

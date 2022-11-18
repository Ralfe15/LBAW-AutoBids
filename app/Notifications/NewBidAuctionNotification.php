<?php

namespace App\Notifications;

use App\Models\Auction;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewBidAuctionNotification extends Notification
{
    use Queueable;
    public Auction $auc;
    public $new_value;


    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Auction $auc, $new_value)
    {
        $this->auc = $auc;
        $this->new_value = $new_value;
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
            'new_val' => $this->new_value,
            'auction_name' => $this->auc->model->brand->name. " - " .
                $this->auc->model->name . " - "  . $this->auc->year,
        ];
    }
}

<?php

namespace App\Notifications;

use App\Models\Auction;
use App\Models\User;
use Illuminate\Bus\Queueable;

use Illuminate\Notifications\Notification;

class AbortedAuctionNotificationNoBids extends Notification
{
    use Queueable;

    public Auction $auction;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Auction $auction)
    {
        $this->auction = $auction;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'auction_name' => $this->auction->model->brand->name . " - " .
                $this->auction->model->name . " - " . $this->auction->year,
            'auction_owner' => $this->auction->user->name,
        ];
    }
}

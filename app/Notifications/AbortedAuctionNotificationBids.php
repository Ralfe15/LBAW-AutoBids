<?php

namespace App\Notifications;

use App\Models\Auction;
use App\Models\Bid;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AbortedAuctionNotificationBids extends Notification
{
    use Queueable;

    public Bid $winner;
    public Auction $auction;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Auction $auction, Bid $winner)
    {
        $this->auction = $auction;
        $this->winner = $winner;
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
            'winner_name' => $this->winner->user->name,
            'auction_name' => $this->auction->model->brand->name . " - " .
                $this->auction->model->name . " - " . $this->auction->year,
            'auction_owner' => $this->auction->user->name,
            'winner_bid' => $this->auction->bids->max('value'),
        ];
    }

    public function toMail($notifiable){

    }
}

<?php
if (!function_exists('bid_step')) {
    function bid_step($current_bid)
    {
        $table = array(100 => 5000, 50 => 2500, 25 => 1000, 10 => 500, 5 => 250, 2.5 => 100,
            1 => 25, 0.5 => 5, 0.25 => 1, 0.05 => 0.01);
        foreach ($table as $incr => $max) {
            if ($current_bid >= $max) {
                $current_bid += $incr;
                break;
            }
        }

        return $current_bid;
    }
}
if (!function_exists('credits_format')) {
    function credits_format($credits)
    {
        return number_format($credits, 2, '.');
    }
}
if (!function_exists('secsToStr')) {
    function secsToStr($init)
    {
        $day = floor($init / 86400);
        $hours = floor(($init - ($day * 86400)) / 3600);
        $minutes = floor(($init / 60) % 60);
        $seconds = $init % 60;

        return $day." day(s), " . $hours . " hour(s), " . $minutes ." minute(s), " .$seconds . " second(s).";
    }
}

if (!function_exists('processTimeHTML')) {
    function processTimeHTML($timestring, $id)
    {
        if (str_contains($timestring, "seconds") || str_contains($timestring, "second")) {
            return $id . "-count";
        }
        return $id . "-nocount";
    }
}

if (!function_exists('dateToSeconds')) {
    function dateToSeconds($d, $h, $m, $s)
    {
        return (intval($d) * 86400) + (intval($h) * 3600) + (intval($m) * 60) + intval($s);
    }
}

if (!function_exists('processNotification')) {
    function processNotification($notification)
    {
        switch ($notification->type) {
            case 'App\\Notifications\\ApprovedAuctionNotification':
                return $notification->data['auction_owner'] . ", your auction named " .
                    $notification->data['auction_name'] . " was approved at " .
                    date("Y-m-d H:i:s", $notification->created_at->timestamp) . ".";
            case 'App\\Notifications\\DeniedAuctionNotification':
                return $notification->data['auction_owner'] . ", your auction named " .
                    $notification->data['auction_name'] . " was denied at " .
                    date("Y-m-d H:i:s", $notification->created_at->timestamp) . ".";
            case 'App\\Notifications\\EndAuctionNotificationNoBids':
                return $notification->data['auction_owner'] . ", your auction named " .
                    $notification->data['auction_name'] . " ended with no bids at " .
                    date("Y-m-d H:i:s", $notification->created_at->timestamp) . ".";
            case 'App\\Notifications\\AbortedAuctionNotificationNoBids':
                return $notification->data['auction_owner'] . ", your auction named " .
                    $notification->data['auction_name'] . " was ABORTED with no bids at " .
                    date("Y-m-d H:i:s", $notification->created_at->timestamp) . ".";
            case 'App\\Notifications\\EndAuctionNotificationBids':
                return "The auction named " .
                    $notification->data['auction_name'] . " ended with a highest bid of U$" .
                    credits_format($notification->data['winner_bid'] / 100) . " made by " . $notification->data['winner_name'] .
                    " at " . date("Y-m-d H:i:s", $notification->created_at->timestamp) . ".";
            case 'App\\Notifications\\AbortedAuctionNotificationBids':
                return "The auction named " .
                    $notification->data['auction_name'] . " was ABORTED. The highest bid of U$" .
                    credits_format($notification->data['winner_bid'] / 100) . " made by " . $notification->data['winner_name'] .
                    " at " . date("Y-m-d H:i:s", $notification->created_at->timestamp) . "was repaid.";
            case 'App\\Notifications\\NewBidAuctionNotification':
                return "An auction you have previously bid has a new bid with value of U$" . credits_format($notification->data['new_val'] / 100);
            case 'App\\Notifications\\NewCommentNotification':
                return "New Comment on Auction: " . $notification->data['auction_name'];
            case 'App\\Notifications\\NewReplyNotification':
                return "New Reply on Auction: " . $notification->data['auction_name'];
            default:
                return $notification;
        }
    }
}

if (!function_exists('processNotificationEmail')) {
    function processNotificationEmail($notification)
    {
        switch ($notification['type']) {
            case 'App\\Notifications\\ApprovedAuctionNotification':
                return $notification['auction_owner'] . ", your auction named " .
                    $notification['auction_name'] . " was approved.";
            case 'App\\Notifications\\DeniedAuctionNotification':
                return $notification['auction_owner'] . ", your auction named " .
                    $notification['auction_name'] . " was denied.";
            case 'App\\Notifications\\EndAuctionNotificationNoBids':
                return $notification['auction_owner'] . ", your auction named " .
                    $notification['auction_name'] . " ended with no bids.";
            case 'App\\Notifications\\AbortedAuctionNotificationNoBids':
                return $notification['auction_owner'] . ", your auction named " .
                    $notification['auction_name'] . " was ABORTED with no bids.";
            case 'App\\Notifications\\EndAuctionNotificationBids':
                return "The auction named " .
                    $notification['auction_name'] . " ended with a highest bid of U$" .
                    credits_format($notification['winner_bid'] / 100) . " made by " . $notification['winner_name'] .
                    ".";
            case 'App\\Notifications\\AbortedAuctionNotificationBids':
                return "The auction named " .
                    $notification['auction_name'] . " was ABORTED. The highest bid of U$" .
                    credits_format($notification['winner_bid'] / 100) . " made by " . $notification['winner_name'] .
                    "was repaid.";
            case 'App\\Notifications\\NewBidAuctionNotification':
                return "An auction you have previously bid has a new bid with value of U$" . credits_format($notification['new_val'] / 100);
            case 'App\\Notifications\\NewCommentNotification':
                return "New Comment on Auction: " . $notification['auction_name'];
            case 'App\\Notifications\\NewReplyNotification':
                return "New Reply on Auction: " . $notification['auction_name'];
            default:
                return $notification;
        }
    }
}


<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class FollowAuction extends Model
{
    protected $table = 'followauction';

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'id_member', 'id');
    }

    public function auction()
    {
        return $this->belongsTo('App\Models\Auction', 'id_auction', 'id');
    }
}

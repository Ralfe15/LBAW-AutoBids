<?php

namespace App\Models;
use http\Env\Request;
use Illuminate\Database\Eloquent\Model;

class AuctionReport extends Model
{
    protected $table = "reportauction";
    public $timestamps = false;

    protected $fillable = [
        'date', 'description'
    ];
    public function user(){
        return $this->belongsTo('App\Models\User', 'id_member', 'id');
    }
    public function auction(){
        return $this->belongsTo('App\Models\Auction', 'id_auction', 'id');
}
}

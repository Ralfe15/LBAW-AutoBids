<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    public $timestamps = false;

    protected $table = "bid";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'value'
    ];

    public function user(){
        return $this->belongsTo('App\Models\User', 'id_member', 'id');
    }

    public function auction(){
        return $this->belongsTo('App\Models\Auction', 'id_auction', 'id');
    }
}

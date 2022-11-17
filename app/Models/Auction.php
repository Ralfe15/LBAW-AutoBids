<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Auction extends Model
{
    public $timestamps  = false;

    protected $table = "auction";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'starting_bid', 'number_bids', 'password', 'address', 'end_date', 'description', 'duration', 'year', 'mileage',
        'displacement', 'vin', 'power', 'color'
    ];

    public function user() {
        return $this->belongsTo('App\Models\User', 'id_member');
    }

    public function model(){
        return $this->hasOne('App\Models\CarModel', 'id', 'id_model');
    }

    public function category(){
        return $this->hasOne('App\Models\Category', 'id', 'id_category');
    }


}

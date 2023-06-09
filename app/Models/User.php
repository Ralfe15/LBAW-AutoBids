<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    // Don't add create and update timestamps in database.
    public $timestamps  = false;

    // Table name in pgsql
    protected $table = 'member';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'address'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The cards this user owns.
     */
    public function auctions() {
      return $this->hasMany('App\Models\Auction', 'id_member');
    }
    public function paypal() {
        return $this->hasMany('App\Models\Paypal', 'id_member');
    }
    public function banktransfer() {
        return $this->hasMany('App\Models\BankTransfer', 'id_member');
    }

    public function  comments() {
        return $this->hasMany('App\Models\Comments', 'id_member');
    }

    public function since() {
        return Carbon::parse($this->account_creation)->toDateTimeString();
    }

    public function getUsername() {
        $full_name = explode(" ", $this->name);
        return $full_name[0] . " " . end($full_name);
    }
}

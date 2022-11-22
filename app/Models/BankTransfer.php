<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BankTransfer extends Model
{
    // Don't add create and update timestamps in database.
    public $timestamps  = false;

    protected $table = 'banktransfer';

    /**
     * The user this bank transaction belongs to
     */
    public function user() {
        return $this->belongsTo('App\Models\User');
    }

}

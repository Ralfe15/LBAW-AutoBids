<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paypal extends Model
{
  // Don't add create and update timestamps in database.
  public $timestamps  = false;
  protected $table = 'paypal';

  /**
   * The user this paypal transaction belongs to
   */
  public function user() {
    return $this->belongsTo('App\Models\User', 'id_member', 'id');
  }

}

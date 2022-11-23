<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    // Don't add create and update timestamps in database.
    public $timestamps  = false;

    protected $table = "image";
    protected $primaryKey = 'id';

    /**
     * The auction this image belongs to
     */
    public function images() {
        return $this->belongsTo('App\Models\Auction', 'id_auction', 'id');
    }
}

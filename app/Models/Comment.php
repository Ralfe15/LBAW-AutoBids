<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comment';
    public $timestamps = false;

    public function user() {
        return $this->belongsTo('App\Models\User', 'id_member', 'id');
    }
    public function auction() {
        return $this->belongsTo('App\Models\Auction', 'id_auction', 'id');
    }
    public function parent() {
        return $this->belongsTo('App\Models\Comment', 'id_comment', 'id');
    }
    public function children() {
        return $this->hasMany('App\Models\Comment', 'id_comment', 'id');
    }
    public function date() {
        return Carbon::parse($this->post_date)->toDateTimeString();
    }
}

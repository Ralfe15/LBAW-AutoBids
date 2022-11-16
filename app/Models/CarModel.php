<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class CarModel extends Model
{
    protected $table = 'model';

    protected $primaryKey = 'id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];
    public function brand(){
        return $this->hasOne('App\Models\Brand', 'id', 'id_brand');
    }
}

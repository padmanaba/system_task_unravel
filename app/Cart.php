<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'cart';


    public function user()
    {
        return $this->belongsTo('App\User','user_id','id');
    }

    public function item()
    {
        return $this->belongsTo('App\Items','item_id','id');
    }
}

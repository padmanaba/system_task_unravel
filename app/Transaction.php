<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transaction';


    public function user()
    {
        return $this->belongsTo('App\User','user_id','id');
    }

    public function item()
    {
        return $this->belongsTo('App\Items','item_id','id');
    }
}

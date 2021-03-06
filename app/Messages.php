<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Messages extends Model
{
    protected $table = 'messages';

    public $timestamps = false;
    

     public function user()
    {
        return $this->belongsTo('App\User','receiver_id','id');
    }
}

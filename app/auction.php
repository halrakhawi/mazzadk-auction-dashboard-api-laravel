<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class auction extends Model
{
    //
    protected $primaryKey = 'auctionid';
    protected $fillable = [

        'startingtime', 'endtime','price','rate','user_id','product_id'

    ];
}

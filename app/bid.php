<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class bid extends Model
{
    protected $primaryKey = 'bidid';
    protected $fillable = [

        'product_id','user_id','bidprice', 'currentprice','biddingtime'

    ];
}

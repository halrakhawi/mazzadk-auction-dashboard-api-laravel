<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\vedioRequest;

class Product extends Model
{
    //
    protected $fillable = [

        'productname', 'productdetail','picture','cat_id','remainingtime','price','user_id'

    ];

    public function category(){
        return $this->belongsTo('App\category');
    }
}

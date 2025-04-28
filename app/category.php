<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    //
    protected $fillable = [

        'cat_name'

    ];

    public function products(){
        return $this->hasMany('App\product');
    }
}

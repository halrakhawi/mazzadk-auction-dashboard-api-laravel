<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vedioRequest extends Model
{
    public $table='vedioRequest';
    protected $fillable = [

        'user_id','product_id','details','done','url'

    ];
}

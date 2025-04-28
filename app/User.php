<?php

  

namespace App;

  

use Illuminate\Notifications\Notifiable;

use Illuminate\Contracts\Auth\MustVerifyEmail;

use Laravel\Passport\HasApiTokens;

use Illuminate\Foundation\Auth\User as Authenticatable;

use Laravel\Cashier\Billable;
  

class User extends Authenticatable implements MustVerifyEmail

{

    use HasApiTokens, Notifiable, Billable;

  

    /**

     * The attributes that are mass assignable.

     *

     * @var array

     */

    protected $fillable = [

        'username', 'email', 'password'

    ];

  

    /**

     * The attributes that should be hidden for arrays.

     *

     * @var array

     */

    protected $hidden = [

        'password', 'remember_token',

    ];


}
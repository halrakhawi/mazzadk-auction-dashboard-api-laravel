<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Cart extends Model
{
    public $table='cart';
    protected $fillable = ['id','content','key','userID'];
    public $incrementing = false;
    public function items () {
        return $this->hasMany('App\CartItem', 'Cart_id');
    }
}
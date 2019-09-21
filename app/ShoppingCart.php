<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property int user_id
 * @property boolean completed
 */
class ShoppingCart extends Model
{
    protected $fillable = [
        'user_id', 'completed'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
    public function products()
    {
        return $this->belongsToMany('App\Product', 'product_shoppingcart', 'shoppingcart_id', 'product_id');
    }
}

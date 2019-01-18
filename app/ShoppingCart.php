<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property boolean completed
 */
class ShoppingCart extends Model
{
    protected $fillable = [
        'completed',
    ];

    public function products()
    {
        return $this->belongsToMany('App\Product', 'product_shoppingcart', 'shoppingcart_id', 'product_id');
    }
}

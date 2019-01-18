<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property string title
 * @property float price
 * @property int inventory_count
 */
class Product extends Model
{
    protected $fillable = [
        'title', 'price', 'inventory_count',
    ];

    public function shoppingcarts()
    {
        return $this->belongsToMany('App\ShoppingCart', 'product_shoppingcart', 'product_id', 'shoppingcart_id');
    }
}

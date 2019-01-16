<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string title
 * @property float price
 * @property int inventory_count
 */
class Product extends Model
{
    protected $fillable = [
        'title', 'price', 'inventory_count',
    ];
}

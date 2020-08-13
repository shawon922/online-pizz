<?php

namespace App\Models;

use App\Models\BaseModel as Model;

class OrderProduct extends Model
{
    protected $table = 'order_product';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_id', 
        'product_id', 
        'quantity',
        'unit_price'
    ];
}

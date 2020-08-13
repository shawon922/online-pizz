<?php

namespace App\Models;

use App\Models\BaseModel as Model;

class Cart extends Model
{
    protected $table = 'carts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id', 
        'quantity',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'date:Y/m/d H:i',
        'updated_at' => 'date:Y/m/d H:i',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['unit_price', 'product_total', ];

    /**
     * Get unit price
     *
     * @return number
     */
    public function getUnitPriceAttribute()
    {
        try {
            $unitPrice = $this->product->unit_price;
        } catch (\Exception $e) {
            $unitPrice = 0;
        }

        return number_format($unitPrice, 2, '.', '');
    }
    /**
     * Get product total (quantity * unit_price)
     *
     * @return number
     */
    public function getProductTotalAttribute()
    {
        try {
            $total = $this->quantity * $this->product->unit_price;
        } catch (\Exception $e) {
            $total = 0;
        }

        return number_format($total, 2, '.', '');
    }

    /**
     * Cart item belongs to a product
     */
    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }
}

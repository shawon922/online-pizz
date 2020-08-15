<?php

namespace App\Models;

use App\Models\BaseModel as Model;

class Order extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_number',
        'billing_name',
        'billing_phone',
        'billing_email',
        'billing_address',
        'billing_city',
        'billing_province',
        'billing_country',
        'billing_postalcode',
    ];

    public function products()
    {
        return $this->belongsToMany('App\Models\Product')->withPivot('quantity', 'unit_price')->withTimestamps();
    }
}

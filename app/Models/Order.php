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

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['currency_symbol', ];

    /**
     * Get currency symbol
     *
     * @return string
     */
    public function getCurrencySymbolAttribute()
    {   
        $currencyType = request()->header('Currency-Type') ? request()->header('Currency-Type') : 'USD';

        return $currencyType === 'EUR' ? '€' : '$';
    }


    public function products()
    {
        return $this->belongsToMany('App\Models\Product')->withPivot('quantity', 'unit_price')->withTimestamps();
    }
}

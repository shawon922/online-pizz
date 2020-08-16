<?php

namespace App\Models;

use App\Models\BaseModel as Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use RaggiTech\Laravel\Currency\HasCurrency;

class Product extends Model
{
    use HasCurrency;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'slug',
        'image_path',
        'description',
        'in_stock',
        'unit_price',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'featured' => 'boolean',
        'created_at' => 'date:Y/m/d H:i',
        'updated_at' => 'date:Y/m/d H:i',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['full_image_path', 'currency_symbol', 'currency_unit_price', ];

    /**
     * Generate and set unique slug
     */
    public function setSlugAttribute($value)
    {
        $original = $slug = Str::slug($value);
        $counter = 1;

        while (static::whereSlug($slug)->exists()) {
            $slug = "{$original}-" . $counter++;
        }
    
        $this->attributes['slug'] = $slug;
    }
    
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

    /**
     * Get currency based price
     *
     * @return number
     */
    public function getCurrencyUnitPriceAttribute()
    {   
        $currencyType = request()->header('Currency-Type') ? request()->header('Currency-Type') : 'USD';

        return $this->currency($currencyType);
    }

    /**
     * Get full image url.
     *
     * @return string
     */
    public function getFullImagePathAttribute()
    {
        if (empty($this->image_path)) {
            return asset('no-image.png');
        }
        
        return Str::startsWith($this->image_path, 'images/') ? asset('storage/'. $this->image_path) : $this->image_path;
    }

    /**
     * 
     *
     * @var string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Traits\ModelTrait;


class BaseModel extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are partially match filterable.
     *
     * @var array
     */
    protected $partialFilterable = [
        
    ];


    /**
     * The attributes that are exact match filterable.
     *
     * @var array
     */
    protected $exactFilterable = [
        'id',
    ];

    /**
     * filter data based request parameters
     * 
     * @param array $params
     * @return $query
     */
    public function filter($params)
    {
        $query = $this->newQuery();
        $request = request();
        $authUser = $request->user();
        

        return $query;
    }    
}

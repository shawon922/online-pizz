<?php

namespace App\Models;

use App\Models\BaseModel as Model;

class Tag extends Model
{ 
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'name', 
  ];

}

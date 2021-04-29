<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps = false;
    
    protected $table = 'categories';

    public function businesses()
    {
        return $this->hasMany('App\Models\Business');
    }
}

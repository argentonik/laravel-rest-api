<?php

namespace App\Models;

use App\Models\Base\FilterableModel;

class Business extends FilterableModel
{
    protected $table = 'businesses';

    protected $fillable = [
        'name',
        'owner_id',
        'description',
        'category_id',
        'raiting',
        'phone',
        'email',
        'website'
    ];

    protected $hidden = [
        'category_id'
    ];

    protected $with = [
        'category'
    ];

    public static function baseFields()
    {
        return [
            'business.id', 
            'business.name', 
            'description', 
            'raiting',
            'category_id'
        ];
    }

    public static function searchFields() 
    {
        return [
            'business.name',
            'description',
            'raiting',
            'category.name'
        ];
    }

    public static function sortableFields() 
    {
        return [
            'business.name',
            'description',
            'raiting',
            'category.name'
        ];
    }

    public static function filterableFields()
    {
        return [
            'category.id',
            'raiting'
        ];
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function scopeJoinCategory($query)
    {
        $query->join('categories as category', 'business.category_id', '=', 'category.id');

        return $query;
    }
}

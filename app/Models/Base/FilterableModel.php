<?php

namespace App\Models\Base;

use Illuminate\Database\Eloquent\Model;

abstract class FilterableModel extends Model
{
    abstract public static function searchFields();

    abstract public static function sortableFields();

    abstract public static function filterableFields();

    public static function directions()
    {
        return [
            'asc',
            'desc'
        ];
    }

    // q=search_string
    public function scopeSearch($query, $param)
    {
        if ($param) {
            foreach(static::searchFields() as $field) {
                $query->orWhere($field, 'LIKE', '%' . $param . '%');
            }
        }
        return $query;
    }

    // sort=field_name+direction,field_name+direction...
    public function scopeSort($query, $params = [])
    {
        if (!empty($params)) {
            foreach($params as $field => $direction) {
                if (in_array($field, static::sortableFields()) 
                    && in_array($direction, self::directions())) {
                        $query->orderBy($field, $direction);
                }
            }
        } else {
            $query->orderBy('updated_at');
        }

        return $query;
    }

    // filter=field_name+value,field_name+value
    public function scopeFilter($query, $params)
    {
        foreach($params as $field => $value) {
            if (in_array($field, static::filterableFields())) {
                $query->where($field, '=', $value);
            }
        }
    }
}
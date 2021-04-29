<?php

namespace App\Services\Base;

class FilterableService 
{
    protected function prepareParams($request)
    {
        $queryQ = $request->query('q');
        $queryFilter = $request->query('filter');
        $querySort = $request->query('sort');

        $q = $queryQ ? $queryQ : null;
        $filter = $this->queryStringToArray($queryFilter);
        $sort = $this->queryStringToArray($querySort);

        return [
            'search' => $q,
            'sort' => $sort,
            'filter' => $filter
        ];
    }

    // field+value,field+value
    private function queryStringToArray($queryString)
    {
        $queryArray = [];
        if ($queryString) {
            $querySortExploded = explode(',', $queryString);
            foreach( $querySortExploded as $querySortItem) {
                $querySortItemDetails =  explode(' ', $querySortItem);
                $queryArray[$querySortItemDetails[0]] = $querySortItemDetails[1];
            }
        }

        return $queryArray;
    }
}
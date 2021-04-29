<?php

namespace App\Services;

use App\Models\Business;
use App\Services\Base\FilterableService;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\DB;

class BusinessService extends FilterableService
{
    public function getAll($request)
    {
        $params = $this->prepareParams($request);
        
        return Business::from('businesses as business')
            ->joinCategory()
            ->select(...Business::baseFields())
            ->search($params['search'])
            ->sort($params['sort'])
            ->filter($params['filter'])
            ->paginate(10);
    }

    public function countPerDay($currentUser, $ownerIdParam, $from, $to) 
    {
        if ($currentUser->hasRole('admin')) {
            $ownerId = $ownerIdParam;
        } else {
            $ownerId = $currentUser->id;
        }

        // create array of all days with business count 0
        $dates = $this->createArrayOfDates($from, $to);
        $dbQueryResult = $this->getBusinessCountForDates($dates, $ownerId);

        $countPerDay = $dates->merge($dbQueryResult);

        return $countPerDay;
    }

    private function createArrayOfDates($from, $to) {
        $dates = collect();
        $period = CarbonPeriod::create($from, $to);

        foreach ($period as $date) {
            $dates->put($date->format('Y-m-d'), 0);
        }

        return $dates;
    }

    private function getBusinessCountForDates($dates, $ownerId) {
        $dbQuery = Business::select([
            DB::raw('DATE(created_at) AS date'),
            DB::raw('COUNT(id) AS count'),
         ])
        ->whereBetween('created_at', [
            $dates->keys()->first(), 
            Carbon::createFromFormat('Y-m-d', $dates->keys()->last())->addDays(1)->toDateString() 
        ]); 
        
        if ($ownerId) {
            $dbQuery->where('owner_id', '=', $ownerId);
        }
        
        $dbQueryResult = $dbQuery
            ->groupBy('date')
            ->orderBy('date', 'DESC')
            ->pluck( 'count', 'date' );

        return $dbQueryResult;
    }
}
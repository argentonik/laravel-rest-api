<?php

namespace App\Http\Middleware;

use App\Models\Business;
use App\Services\BusinessService;
use Closure;

class OwnerMiddleware
{
    public function __construct(BusinessService $businessService)
    {
        $this->businessService = $businessService;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $businessId = $request->segments()[2];
        $business = Business::findOrFail($businessId);

        if (($business->owner_id != $request->user()->id) && !$request->user()->hasRole('admin')) {
            abort(403, 'Editing is available only to the creator.');
        }

        return $next($request);
    }
}

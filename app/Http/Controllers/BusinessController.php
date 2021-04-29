<?php

namespace App\Http\Controllers;

use App\Http\Requests\Business\BusinessDeleteRequest;
use App\Http\Requests\Business\BusinessRequest;
use App\Http\Requests\Business\BusinessStoreRequest;
use App\Http\Requests\Business\BusinessUpdateRequest;
use Illuminate\Http\Request;
use App\Http\Resources\BaseResource;
use App\Models\Business;
use App\Services\BusinessService;

class BusinessController extends Controller
{
    public function __construct(BusinessService $businessService)
    {
        $this->businessService = $businessService;
    }

    /**
     * @OA\Get(
     *      path="/api/businesses",
     *      operationId="getBusinessesList",
     *      tags={"Businesses"},
     *      summary="Get list of businesses",
     *      description="Returns list of businesses",
     *      security={{"passport": {"*"}}},
     *      @OA\Parameter(
     *          name="q",
     *          in="query",
     *          description="Search businesses by query string value.",
     *          required=false,
     *       ),
     *      @OA\Parameter(
     *          name="sort",
     *          in="query",
     *          description="Sort businesses by query string value.",
     *          required=false,
     *          example="raiting asc;business.name desc",
     *          @OA\Schema( 
     *              type="array", 
     *              @OA\Items( type="enum", enum={
     *                  "business.name asc",
     *                  "business.name desc",
     *                  "description asc",
     *                  "description desc",
     *                  "raiting asc",
     *                  "raiting desc",
     *                  "category.name asc",
     *                  "category.name desc",
     *              } ),
     *          ),
     *       ),
     *      @OA\Parameter(
     *          name="filter",
     *          in="query",
     *          description="Filter businesses by query string value. (by category.id, by raiting)",
     *          required=false,
     *          example="category.id 1"
     *       ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/BusinessListResource")
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *          @OA\JsonContent(ref="#/components/schemas/UnauthenticatedResource")
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden",
     *          @OA\JsonContent(ref="#/components/schemas/ForbiddenResource")
     *      )
     *     )
     */
    public function index(Request $request)
    {
        return new BaseResource([
            'list' => $this->businessService->getAll($request)
        ]);
    }

    /**
     * @OA\Get(
     *      path="/api/businesses/{id}",
     *      operationId="getBusinessById",
     *      tags={"Businesses"},
     *      summary="Get business information",
     *      description="Returns business data",
     *      security={{"passport": {"*"}}},
     *      @OA\Parameter(
     *          name="id",
     *          description="Business id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/BusinessResource")
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request",
     *          @OA\JsonContent(ref="#/components/schemas/BadRequestResource")
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *          @OA\JsonContent(ref="#/components/schemas/UnauthenticatedResource")
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden",
     *          @OA\JsonContent(ref="#/components/schemas/ForbiddenResource")
     *      )
     * )
     */
    public function show($id)
    {
        return new BaseResource([
            'business' => Business::findOrFail($id)
        ]);
    }

    /**
     * @OA\Post(
     *      path="/api/businesses",
     *      operationId="storeBusiness",
     *      tags={"Businesses"},
     *      summary="Store new business",
     *      description="Returns business data",
     *      security={{"passport": {"*"}}},
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/StoreBusinessRequest")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/BusinessResource")
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request",
     *          @OA\JsonContent(ref="#/components/schemas/BadRequestResource")
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *          @OA\JsonContent(ref="#/components/schemas/UnauthenticatedResource")
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden",
     *          @OA\JsonContent(ref="#/components/schemas/ForbiddenResource")
     *      )
     * )
     */
    public function store(BusinessStoreRequest $request)
    {
        $request['owner_id'] = $request->user()->id;
        Business::create($request->all());
        
        return (new BaseResource([
            'business' => Business::all()->last()
            ]))
            ->response()
            ->setStatusCode(201);
    }

     /**
     * @OA\Put(
     *      path="/api/businesses/{id}",
     *      operationId="updateBusiness",
     *      tags={"Businesses"},
     *      summary="Update existing business",
     *      description="Returns updated business data",
     *      security={{"passport": {"*"}}},
     *      @OA\Parameter(
     *          name="id",
     *          description="Business id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UpdateBusinessRequest")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/BusinessResource")
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request",
     *          @OA\JsonContent(ref="#/components/schemas/BadRequestResource")
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *          @OA\JsonContent(ref="#/components/schemas/UnauthenticatedResource")
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden",
     *          @OA\JsonContent(ref="#/components/schemas/ForbiddenResource")
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found",
     *          @OA\JsonContent(ref="#/components/schemas/NotFoundResource")
     *      )
     * )
     */
    public function update(BusinessUpdateRequest $request, $id)
    {
        $business = Business::findOrFail($id);
        $business->update($request->all());
        $business = $business->fresh();

        return new BaseResource([
            'business' => $business
        ]);
    }

     /**
     * @OA\Delete(
     *      path="/api/businesses/{id}",
     *      operationId="deleteBusiness",
     *      tags={"Businesses"},
     *      summary="Delete existing business",
     *      description="Deletes a record and returns no content",
     *      security={{"passport": {"*"}}},
     *      @OA\Parameter(
     *          name="id",
     *          description="Business id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/DeleteResource")
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *          @OA\JsonContent(ref="#/components/schemas/UnauthenticatedResource")
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden",
     *          @OA\JsonContent(ref="#/components/schemas/ForbiddenResource")
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found",
     *          @OA\JsonContent(ref="#/components/schemas/NotFoundResource")
     *      )
     * )
     */
    public function delete(BusinessDeleteRequest $request, $id)
    {
        $business = Business::findOrFail($id);
        $business->delete();

        return new BaseResource(null);
    }

    /**
     * @OA\Get(
     *      path="/api/businesses/statistics",
     *      operationId="getCountOfBusinessesPerDay",
     *      tags={"Businesses"},
     *      summary="Get count of businesses per day",
     *      description="Returns count of businesses",
     *      security={{"passport": {"*"}}},
     *      @OA\Parameter(
     *          name="from",
     *          in="query",
     *          description="Start date of period",
     *          required=true,
     *          example="2020-08-02"
     *       ),
     *      @OA\Parameter(
     *          name="to",
     *          in="query",
     *          description="End date of period",
     *          required=true,
     *          example="2020-08-03"
     *       ),
     *      @OA\Parameter(
     *          name="owner_id",
     *          in="query",
     *          description="Filtering by owner id (available only for admin)",
     *          required=false,
     *       ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/BusinessCountPerDayResource")
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *          @OA\JsonContent(ref="#/components/schemas/UnauthenticatedResource")
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden",
     *          @OA\JsonContent(ref="#/components/schemas/ForbiddenResource")
     *      )
     *     )
     */
    public function countOfBusinessesPerDay(Request $request)
    {
        $user = $request->user();
        $ownerIdParam = $request->query('owner_id');
        $from = $request->query('from');
        $to = $request->query('to');

        $data = $this->businessService->countPerDay(
            $user,
            $ownerIdParam,
            $from,
            $to
        );
        return new BaseResource([
            'businessesToDay' => $data
        ]);
    }
}

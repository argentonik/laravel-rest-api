<?php

use Virtual\Resources\Base\SuccessResource;

/**
 * @OA\Schema(
 *     title="BusinessListResource",
 *     description="Business list resource",
 *     @OA\Xml(
 *         name="BusinessListResource"
 *     )
 * )
 */
class BusinessListResource extends SuccessResource
{
    /**
     * @OA\Property(
     *     property="data",
     *     title="Data",
     *     description="Data wrapper",
     *     @OA\Property(
     *         property="list",
     *         title="Business list",
     *         description="Business list wrapper"
     *     )
     * )
     *
     * @var \App\Virtual\Models\BusinessList
     */
    private $business;
}
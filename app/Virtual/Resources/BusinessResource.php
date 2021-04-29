<?php

use Virtual\Resources\Base\SuccessResource;

/**
 * @OA\Schema(
 *     title="BusinessResource",
 *     description="Business resource",
 *     @OA\Xml(
 *         name="BusinessResource"
 *     )
 * )
 */
class BusinessResource extends SuccessResource
{
    /**
     * @OA\Property(
     *     property="data",
     *     title="Data",
     *     description="Data wrapper",
     *     @OA\Property(
     *         property="business",
     *         title="Business",
     *         description="Business wrapper"
     *     )
     * )
     *
     * @var \App\Virtual\Models\Business
     */
    private $business;
}
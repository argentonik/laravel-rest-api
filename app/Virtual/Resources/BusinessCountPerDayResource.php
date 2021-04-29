<?php

use Virtual\Resources\Base\SuccessResource;

/**
 * @OA\Schema(
 *     title="BusinessCountPerDayResource",
 *     description="Business count per day resource",
 *     @OA\Xml(
 *         name="BusinessCountPerDayResource"
 *     )
 * )
 */
class BusinessCountPerDayResource extends SuccessResource
{
    /**
     * @OA\Property(
     *     property="data",
     *     title="Data",
     *     description="Data wrapper",
     *     @OA\Property(
     *         property="businessesToDay",
     *         title="Businesses to day",
     *         description="Businesses to day wrapper",
     *             @OA\Property(
     *                 property="2020-08-01",
     *                 type="int64",
     *                 example=1,
     *             ),
     *             @OA\Property(
     *                 property="2020-08-02",
     *                 type="int64",
     *                 example=0,
     *             ),
     *             @OA\Property(
     *                 property="2020-08-03",
     *                 type="int64",
     *                 example=5,
     *             )
     *     )
     * )
     *
     */
    private $businessesToDay;
}
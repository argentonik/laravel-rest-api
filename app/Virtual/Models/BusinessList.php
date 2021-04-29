<?php

namespace App\Virtual\Models;

/**
 * @OA\Schema(
 *     title="Business list",
 *     description="Business list model",
 *     @OA\Xml(
 *         name="Business list"
 *     )
 * )
 */
class BusinessList extends BaseList
{
    /**
     * @OA\Property(
     *     property="data",
     *     title="Data",
     *     description="Data wrapper",
     * )
     *
     * @var \App\Virtual\Models\BusinessShortInfo[]
     */
    private $businessShortInfo;
}
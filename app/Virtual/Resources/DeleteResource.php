<?php

use Virtual\Resources\Base\SuccessResource;

/**
 * @OA\Schema(
 *     title="DeleteResource",
 *     description="Delete resource",
 *     @OA\Xml(
 *         name="DeleteResource"
 *     )
 * )
 */
class DeleteResource extends SuccessResource
{
    /**
     * @OA\Property(
     *     property="data",
     *     title="Data",
     *     description="Data wrapper",
     *     example="[]"
     * )
     * 
     */
    private $data;
}
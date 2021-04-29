<?php

use Virtual\Resources\Base\ErrorResource;

/**
 * @OA\Schema(
 *     title="BadRequestResource",
 *     description="Bad request resource",
 *     @OA\Xml(
 *         name="BadRequestResource"
 *     )
 * )
 */
class BadRequestResource extends ErrorResource
{
    /**
     * @OA\Property(
     *     title="Message",
     *     description="Message wrapper",
     *     example="Bad request"
     * )
     *
     */
    private $message;
}
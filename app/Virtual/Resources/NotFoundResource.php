<?php

use Virtual\Resources\Base\ErrorResource;

/**
 * @OA\Schema(
 *     title="NotFoundResource",
 *     description="Not found resource",
 *     @OA\Xml(
 *         name="NotFoundResource"
 *     )
 * )
 */
class NotFoundResource extends ErrorResource
{
    /**
     * @OA\Property(
     *     title="Message",
     *     description="Message wrapper",
     *     example="Not found"
     * )
     *
     */
    private $message;
}
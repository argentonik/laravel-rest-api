<?php

use Virtual\Resources\Base\ErrorResource;

/**
 * @OA\Schema(
 *     title="ForbiddenResource",
 *     description="Forbidden resource",
 *     @OA\Xml(
 *         name="ForbiddenResource"
 *     )
 * )
 */
class ForbiddenResource extends ErrorResource
{
    /**
     * @OA\Property(
     *     title="Message",
     *     description="Message wrapper",
     *     example="Forbidden"
     * )
     *
     */
    private $message;
}
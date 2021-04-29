<?php

use Virtual\Resources\Base\ErrorResource;

/**
 * @OA\Schema(
 *     title="UnauthenticatedResource",
 *     description="Unauthenticated resource",
 *     @OA\Xml(
 *         name="UnauthenticatedResource"
 *     )
 * )
 */
class UnauthenticatedResource extends ErrorResource
{
    /**
     * @OA\Property(
     *     title="Status",
     *     description="Status wrapper",
     *     example="failed"
     * )
     *
     */
    private $status;

    /**
     * @OA\Property(
     *     title="Message",
     *     description="Message wrapper",
     *     example="Unauthenticated"
     * )
     *
     */
    private $message;
}
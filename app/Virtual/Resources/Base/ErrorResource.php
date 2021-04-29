<?php

namespace Virtual\Resources\Base;

/**
 * @OA\Schema(
 *     title="ErrorResource",
 *     description="Error resource",
 *     @OA\Xml(
 *         name="ErrorResource"
 *     )
 * )
 */
class ErrorResource
{
    /**
     * @OA\Property(
     *     title="Status",
     *     description="Status wrapper",
     *     example="error"
     * )
     *
     */
    private $status;
}
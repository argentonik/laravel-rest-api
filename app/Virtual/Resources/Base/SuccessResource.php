<?php

namespace Virtual\Resources\Base;

/**
 * @OA\Schema(
 *     title="SuccessResource",
 *     description="Success resource",
 *     @OA\Xml(
 *         name="SuccessResource"
 *     )
 * )
 */
class SuccessResource
{
    /**
     * @OA\Property(
     *     title="Status",
     *     description="Status wrapper",
     *     example="success"
     * )
     *
     */
    private $status;

    /**
     * @OA\Property(
     *     title="Message",
     *     description="Message wrapper",
     *     example="The operation was successful."
     * )
     *
     */
    private $message;
}
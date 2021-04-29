<?php

use Virtual\Resources\Base\SuccessResource;

/**
 * @OA\Schema(
 *     title="LogoutResource",
 *     description="Logout resource",
 *     @OA\Xml(
 *         name="LogoutResource"
 *     )
 * )
 */
class LogoutResource extends SuccessResource
{
    /**
     * @OA\Property(
     *     property="data",
     *     title="Data",
     *     description="Data wrapper",
     *     type="object",
     * )
     *
     */
    private $data;
}
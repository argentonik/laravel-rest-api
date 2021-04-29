<?php

use Virtual\Resources\Base\SuccessResource;

/**
 * @OA\Schema(
 *     title="LoginResource",
 *     description="Login resource",
 *     @OA\Xml(
 *         name="LoginResource"
 *     )
 * )
 */
class LoginResource extends SuccessResource
{
    /**
     * @OA\Property(
     *     property="data",
     *     title="Data",
     *     description="Data wrapper",
     *     @OA\Property(
     *         property="loginData",
     *         title="Login data",
     *         description="Login data wrapper",
     *             @OA\Property(
     *                 property="access_token",
     *                 type="string",
     *                 example="IxIiwianRpIjoiN2I2NTYxNWM0ZWZmZGFiYWU...",
     *             ),
     *             @OA\Property(
     *                 property="token_type",
     *                 type="string",
     *                 example="Bearer",
     *             ),
     *             @OA\Property(
     *                 property="expires_at",
     *                 type="string",
     *                 example="2021-08-03 18:30:35",
     *             )
     *     )
     * )
     *
     */
    private $loginData;
}
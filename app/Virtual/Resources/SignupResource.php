<?php

use Virtual\Resources\Base\SuccessResource;

/**
 * @OA\Schema(
 *     title="SignupResource",
 *     description="Signup resource",
 *     @OA\Xml(
 *         name="SignupResource"
 *     )
 * )
 */
class SignupResource extends SuccessResource
{
    /**
     * @OA\Property(
     *     property="data",
     *     title="Data",
     *     description="Data wrapper",
     *     @OA\Property(
     *         property="user",
     *         title="User data",
     *         description="User data wrapper",
     *             @OA\Property(
     *                 property="name",
     *                 type="string",
     *                 example="User",
     *             ),
     *             @OA\Property(
     *                 property="email",
     *                 type="string",
     *                 example="test@test.com",
     *             ),
     *             @OA\Property(
     *                 property="id",
     *                 type="int64",
     *                 example=2,
     *             )
     *     )
     * )
     *
     */
    private $loginData;
}
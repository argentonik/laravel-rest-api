<?php

use Virtual\Resources\Base\SuccessResource;

/**
 * @OA\Schema(
 *     title="CurrentUserResource",
 *     description="Current user resource",
 *     @OA\Xml(
 *         name="CurrentUserResource"
 *     )
 * )
 */
class CurrentUserResource extends SuccessResource
{
    /**
     * @OA\Property(
     *     property="data",
     *     title="Data",
     *     description="Data wrapper",
     *     @OA\Property(
     *         property="user",
     *         title="User",
     *         description="User wrapper",
     *              @OA\Property(
     *                 property="id",
     *                 type="int64",
     *                 example=2,
     *             ),
     *              @OA\Property(
     *                 property="name",
     *                 type="string",
     *                 example="User",
     *             ),
     *             @OA\Property(
     *                 property="email",
     *                 type="string",
     *                 example="test@test.com",
     *             ),
     *     )
     * )
     *
     */
    private $loginData;
}
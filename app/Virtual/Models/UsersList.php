<?php

namespace App\Virtual\Models;

/**
 * @OA\Schema(
 *     title="Business list",
 *     description="Business list model",
 *     @OA\Xml(
 *         name="Business list"
 *     )
 * )
 */
class UsersList extends BaseList
{
    /**
     * @OA\Property(
     *     property="data",
     *     title="Data",
     *     description="Data wrapper",
     *     type="array",
     *         @OA\Items(
     *              type="object",
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
     *          ),
     *     )
     * ),
     */
    private $userList;
}
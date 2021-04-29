<?php

use Virtual\Resources\Base\SuccessResource;

/**
 * @OA\Schema(
 *     title="UserListResource",
 *     description="User list resource",
 *     @OA\Xml(
 *         name="UserListResource"
 *     )
 * )
 */
class UserListResource extends SuccessResource
{
    /**
     * @OA\Property(
     *     property="data",
     *     title="Data",
     *     description="Data wrapper",
     *     @OA\Property(
     *         property="usersList",
     *         title="User list",
     *         description="User list wrapper"
     *     )
     * )
     *
     * @var \App\Virtual\Models\UsersList[]
     */
    private $users;
}
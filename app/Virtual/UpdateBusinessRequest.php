<?php

namespace Virtual;

/**
 * @OA\Schema(
 *      title="Update Business request",
 *      description="Update Business request body data",
 *      type="object",
 *      required={
 *          "id",
 *          "name",
 *          "description",
 *          "category_id",
 *          "raiting",
 *          "phone",
 *          "email",
 *          "website"
 *      }
 * )
 */
class UpdateBusinessRequest extends StoreBusinessRequest
{
    /**
     * @OA\Property(
     *     title="ID",
     *     description="ID",
     *     format="int64",
     *     example=1
     * )
     *
     * @var integer
     */
    private $id;
}
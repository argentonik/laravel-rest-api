<?php

namespace App\Virtual\Models;

/**
 * @OA\Schema(
 *     title="Category",
 *     description="Category of business",
 *     @OA\Xml(
 *         name="Category"
 *     )
 * )
 */
class Category
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

    /**
     * @OA\Property(
     *      title="Name",
     *      description="Name of the category",
     *      example="Category name"
     * )
     *
     * @var string
     */
    public $name;
}
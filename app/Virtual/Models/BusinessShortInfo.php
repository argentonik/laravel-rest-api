<?php

namespace App\Virtual\Models;

/**
 * @OA\Schema(
 *     title="Business short info",
 *     description="Business short info model",
 *     @OA\Xml(
 *         name="Business short info"
 *     )
 * )
 */
class BusinessShortInfo
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
     *      description="Name of the business",
     *      example="This is business name"
     * )
     *
     * @var string
     */
    public $name;

    /**
     * @OA\Property(
     *      title="Description",
     *      description="Description of the business",
     *      example="This is business description"
     * )
     *
     * @var string
     */
    public $description;

    /**
     * @OA\Property(
     *     title="Owner ID",
     *     description="Number between 0 and 100",
     *     format="int64",
     *     example=75
     * )
     *
     * @var integer
     */
    private $raiting;

    /**
     * @OA\Property(
     *     title="Category",
     *     description="Category of business model"
     * )
     *
     * @var \App\Virtual\Models\Category
     */
    private $category;
}
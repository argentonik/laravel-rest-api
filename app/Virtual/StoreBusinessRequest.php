<?php

namespace Virtual;

/**
 * @OA\Schema(
 *      title="Store Business request",
 *      description="Store Business request body data",
 *      type="object",
 *      required={
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
class StoreBusinessRequest
{
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
     *     title="category_id",
     *     description="Id of the category",
     *     format="int64",
     *     example=1
     * )
     *
     * @var integer
     */
    private $category_id;

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
     *      title="Phone",
     *      description="Phone of the business",
     *      example="+1 (855) 451-9378"
     * )
     *
     * @var string
     */
    public $phone;

    /**
     * @OA\Property(
     *      title="Email",
     *      description="Contact email",
     *      example="hackett.hector@mante.biz"
     * )
     *
     * @var string
     */
    public $email;

    /**
     * @OA\Property(
     *      title="Website",
     *      description="Website of the business",
     *      example="hackett.hector@mante.biz"
     * )
     *
     * @var string
     */
    public $website;
}
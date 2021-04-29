<?php

namespace App\Virtual\Models;

/**
 * @OA\Schema(
 *     title="Business",
 *     description="Business model",
 *     @OA\Xml(
 *         name="Business"
 *     )
 * )
 */
class Business
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
     *     title="Owner ID",
     *     description="Business creator id",
     *     format="int64",
     *     example=1
     * )
     *
     * @var integer
     */
    private $owner_id;

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

    /**
     * @OA\Property(
     *     title="Created at",
     *     description="Date of created business",
     *     example="2020-01-27 17:50:45",
     *     format="datetime",
     *     type="string"
     * )
     *
     * @var \DateTime
     */
    private $created_at;

    /**
     * @OA\Property(
     *     title="Updated at",
     *     description="Date of updated business",
     *     example="2020-01-27 17:50:45",
     *     format="datetime",
     *     type="string"
     * )
     *
     * @var \DateTime
     */
    private $updated_at;

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
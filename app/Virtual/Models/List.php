<?php

namespace App\Virtual\Models;

/**
 * @OA\Schema(
 *     title="Base list",
 *     description="Base list model",
 *     @OA\Xml(
 *         name="Base list"
 *     )
 * )
 */
class BaseList
{
    /**
     * @OA\Property(
     *     title="current_page",
     *     description="Number of the current page",
     *     format="int64",
     *     example=1
     * )
     *
     * @var integer
     */
    private $currentPage;

    /**
     * @OA\Property(
     *      title="first_page_url",
     *      description="Url of first page",
     *      example="http://rest-api/api/route?page=1"
     * )
     *
     * @var string
     */
    public $firstPageUrl;

    /**
     * @OA\Property(
     *     title="from",
     *     description="Start id of item on current page",
     *     format="int64",
     *     example=1
     * )
     *
     * @var integer
     */
    private $from;

    /**
     * @OA\Property(
     *     title="last_page",
     *     description="Last number page of pagination",
     *     format="int64",
     *     example=1
     * )
     *
     * @var integer
     */
    private $lastPage;

    /**
     * @OA\Property(
     *      title="last_page_url",
     *      description="Url of the last page",
     *      example="http://rest-api/api/route?page=1"
     * )
     *
     * @var string
     */
    public $lastPageUrl;

    /**
     * @OA\Property(
     *      title="next_page_url",
     *      description="Url of the next page",
     *      example=null
     * )
     *
     * @var string
     */
    public $nextPageUrl;

    /**
     * @OA\Property(
     *      title="path",
     *      description="Current path",
     *      example="http://rest-api/api/route"
     * )
     *
     * @var string
     */
    public $path;

    /**
     * @OA\Property(
     *     title="per_page",
     *     description="Count of items per page",
     *     format="int64",
     *     example=10
     * )
     *
     * @var integer
     */
    private $perPage;

    /**
     * @OA\Property(
     *      title="prev_page_url",
     *      description="Url of the previous page",
     *      example=null
     * )
     *
     * @var string
     */
    public $prevPageUrl;

    /**
     * @OA\Property(
     *     title="to",
     *     description="Last id of item on current page",
     *     format="int64",
     *     example=1
     * )
     *
     * @var integer
     */
    private $to;

    /**
     * @OA\Property(
     *     title="total",
     *     description="Count of items on current page",
     *     format="int64",
     *     example=1
     * )
     *
     * @var integer
     */
    private $total;
}
<?php

namespace Virtual;

/**
 * @OA\Schema(
 *      title="Login request",
 *      description="Login request body data",
 *      type="object",
 *      required={
 *          "name",
 *          "email",
 *          "password",
 *          "password_confirmation"
 *      }
 * )
 */
class SignupRequest
{
    /**
     * @OA\Property(
     *      title="Name",
     *      description="Name of the user",
     *      type="string",
     *      example="User",
     * )
     *
     * @var string
     */
    public $name;

    /**
     * @OA\Property(
     *      title="Email",
     *      description="Email of the user",
     *      type="string",
     *      example="test@test.com",
     * )
     *
     * @var string
     */
    public $email;

    /**
     * @OA\Property(
     *      title="Password",
     *      description="Password of the business",
     *      type="password",
     *      example="password",
     * )
     *
     * @var string
     */
    public $password;

    /**
     * @OA\Property(
     *      title="password_confirmation",
     *      description="Password confirmation",
     *      type="password",
     *      example="password",
     * )
     *
     * @var string
     */
    public $password_confirmation;
}
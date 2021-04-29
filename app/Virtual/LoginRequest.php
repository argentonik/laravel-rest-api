<?php

namespace Virtual;

/**
 * @OA\Schema(
 *      title="Login request",
 *      description="Login request body data",
 *      type="object",
 *      required={
 *          "email",
 *          "password",
 *      }
 * )
 */
class LoginRequest
{
    /**
     * @OA\Property(
     *      title="Email",
     *      description="Email of the user",
     *      type="string",
     *      example="admin@admin.com",
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
}
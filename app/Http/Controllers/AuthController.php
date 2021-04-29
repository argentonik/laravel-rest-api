<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SignUpRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\BaseResource;
use App\Http\Resources\UnauthorizedResource;
use App\Services\AuthService;

class AuthController extends Controller
{
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * @OA\Post(
     **  path="/api/auth/signup",
     *   tags={"Authorization"},
     *   summary="Signup",
     *   operationId="signup",
     *
     *   @OA\RequestBody(
     *      required=true,
     *      @OA\JsonContent(ref="#/components/schemas/SignupRequest"),
     *   ),
     *   @OA\Response(
     *      response=201,
     *      description="Success",
     *      @OA\JsonContent(ref="#/components/schemas/SignupResource"),
     *   ),
     *   @OA\Response(
     *      response=401,
     *      description="Unauthenticated",
     *      @OA\JsonContent(ref="#/components/schemas/UnauthenticatedResource"),
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request",
     *      @OA\JsonContent(ref="#/components/schemas/BadRequestResource"),
     *   ),
     *   @OA\Response(
     *      response=404,
     *      description="Not found",
     *      @OA\JsonContent(ref="#/components/schemas/NotFoundResource"),
     *   ),
     *   @OA\Response(
     *      response=403,
     *      description="Forbidden",
     *      @OA\JsonContent(ref="#/components/schemas/ForbiddenResource"),
     *   )
     *)
     **/
    public function signup(SignUpRequest $request)
    {
        $user = $this->authService->signup($request);

        return (new BaseResource([
            'user' => $user
        ]))
            ->response()
            ->setStatusCode(201);
    }

    /**
     * @OA\Get(
     **  path="/api/auth/signup/activate/{id}",
     *   tags={"Authorization"},
     *   summary="Activate user",
     *   operationId="activateUser",
     *   security={{"passport": {"*"}}},
     *   @OA\Parameter(
     *          name="id",
     *          description="User id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *   @OA\Response(
     *      response=201,
     *      description="Success",
     *      @OA\JsonContent(ref="#/components/schemas/SignupResource"),
     *   ),
     *   @OA\Response(
     *      response=401,
     *      description="Unauthenticated",
     *      @OA\JsonContent(ref="#/components/schemas/UnauthenticatedResource"),
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request",
     *      @OA\JsonContent(ref="#/components/schemas/BadRequestResource"),
     *   ),
     *   @OA\Response(
     *      response=404,
     *      description="Not found",
     *      @OA\JsonContent(ref="#/components/schemas/NotFoundResource"),
     *   ),
     *   @OA\Response(
     *      response=403,
     *      description="Forbidden",
     *      @OA\JsonContent(ref="#/components/schemas/ForbiddenResource"),
     *   )
     *)
     **/
    public function signupActivate($id)
    {
        $user = $this->authService->signupActivate($id);

        if (!$user) {
            return response()->json([
                'status' => 'failed',
                'message' => 'User already activated'
            ], 500);
        }

        return new BaseResource([
            'user' => $user
        ]);   
    }

    /**
     * @OA\Post(
     ** path="/api/auth/login",
     *   tags={"Authorization"},
     *   summary="Login",
     *   operationId="login",
     *
     *   @OA\RequestBody(
     *      required=true,
     *      @OA\JsonContent(ref="#/components/schemas/LoginRequest"),
     *   ),
     *   @OA\Response(
     *      response=200,
     *      description="Success",
     *      @OA\JsonContent(ref="#/components/schemas/LoginResource"),
     *   ),
     *   @OA\Response(
     *      response=401,
     *      description="Unauthenticated",
     *      @OA\JsonContent(ref="#/components/schemas/UnauthenticatedResource"),
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request",
     *      @OA\JsonContent(ref="#/components/schemas/BadRequestResource"),
     *   ),
     *   @OA\Response(
     *      response=404,
     *      description="Not found",
     *      @OA\JsonContent(ref="#/components/schemas/NotFoundResource"),
     *   ),
     *   @OA\Response(
     *      response=403,
     *      description="Forbidden",
     *      @OA\JsonContent(ref="#/components/schemas/ForbiddenResource"),
     *   )
     *)
     **/
    /**
     * login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(LoginRequest $request)
    {
        $loginResult = $this->authService->login($request);

        if(!$loginResult) {
            return (new UnauthorizedResource(null))
                ->response()
                ->setStatusCode(401);
        }

        return new BaseResource([
            'loginData' => $loginResult
        ]);
    }

    /**
     * @OA\Get(
     **  path="/api/auth/logout",
     *   tags={"Authorization"},
     *   summary="Logout",
     *   operationId="logout",
     *   security={{"passport": {"*"}}},
     *   
     *   @OA\Response(
     *      response=200,
     *      description="Success",
     *      @OA\JsonContent(ref="#/components/schemas/LogoutResource"),
     *   ),
     *   @OA\Response(
     *      response=401,
     *      description="Unauthenticated",
     *      @OA\JsonContent(ref="#/components/schemas/UnauthenticatedResource"),
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request",
     *      @OA\JsonContent(ref="#/components/schemas/BadRequestResource"),
     *   ),
     *   @OA\Response(
     *      response=403,
     *      description="Forbidden",
     *      @OA\JsonContent(ref="#/components/schemas/ForbiddenResource"),
     *   )
     *)
     **/
    public function logout(Request $request)
    {
        $this->authService->logout($request);
        
        return new BaseResource(null);
    }

    /**
     * @OA\Get(
     ** path="/api/auth/user",
     *   tags={"Authorization"},
     *   summary="Get current user info",
     *   operationId="currentUser",
     *   security={{"passport": {"*"}}},
     *
     *   @OA\Response(
     *      response=200,
     *      description="Success",
     *      @OA\JsonContent(ref="#/components/schemas/CurrentUserResource"),
     *   ),
     *   @OA\Response(
     *      response=401,
     *      description="Unauthenticated",
     *      @OA\JsonContent(ref="#/components/schemas/UnauthenticatedResource"),
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request",
     *      @OA\JsonContent(ref="#/components/schemas/BadRequestResource"),
     *   ),
     *   @OA\Response(
     *      response=404,
     *      description="Not found",
     *      @OA\JsonContent(ref="#/components/schemas/NotFoundResource"),
     *   ),
     *   @OA\Response(
     *      response=403,
     *      description="Forbidden",
     *      @OA\JsonContent(ref="#/components/schemas/ForbiddenResource"),
     *   )
     *)
     **/
    public function user(Request $request)
    {
        return new BaseResource([
            'user' => $request->user()
        ]);
    }
}

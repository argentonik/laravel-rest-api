<?php

namespace App\Services;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Notifications\SignupActivate;

class AuthService
{
    public function signup($request)
    {
        $user = config('roles.models.defaultUser')::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        $role = config('roles.models.role')::where('name', '=', 'Unverified')->first();
        $user->attachRole($role);

        $user->save();

        return $user;
    }

    public function signupActivate($id)
    {
        $user = User::where('id', $id)->first();

        if (!$user || !$user->hasRole('unverified')) {
            return false;
        }

        $unverifiedRole = config('roles.models.role')::where('name', '=', 'Unverified')->first();
        $userRole = config('roles.models.role')::where('name', '=', 'User')->first();

        $user->detachRole($unverifiedRole);
        $user->attachRole($userRole);
        $user->save();

        $user->notify(new SignupActivate($user));

        return $user;
    }

    public function login($request)
    {
        $credentials = request([
            'email', 
            'password',
        ]);
        $credentials['deleted_at'] = null;
        
        if (!Auth::attempt($credentials)) {
            return false;
        }

        $tokenResult = $this->createToken($request);
        return [
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ];
    }

    public function logout($request) 
    {
        $request->user()->token()->revoke();
    }

    private function createToken($request)
    {
        $user = $request->user();

        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();

        return $tokenResult;
    }
}
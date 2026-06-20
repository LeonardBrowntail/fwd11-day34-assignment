<?php

namespace App\Http\Controllers;

use App\ApiResponse;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Hash;

class AuthController extends Controller
{
    use ApiResponse;

    public function register(RegisterRequest $request) {
        if (isset($request->validator) && $request->validator->fails()) {
            return $this->errorResponse($request->validator->errors());
        }
        $valid = $request->validated();
        $valid['password'] = Hash::make($request->validated('password'));
        $user = User::create($valid);
        return $this->generalResponse(true, "Berhasil mendaftar", 200, $user);
    }

    public function login(LoginRequest $request) {
        if (isset($request->validator) && $request->validator->fails()){
            return $this->errorResponse($request->validator->errors());
        }

        // check username
        $user = User::where('email', $request->validated('email'))->first();
        // check password
        $validPass = Hash::check($request->validated('password'), $user->password);
        
        if (!$user || !$validPass) {
            return $this->generalResponse(false, "Email atau password salah", 401);
        }

        $token = $user->createToken('auth-token')->plainTextToken;
        return $this->generalResponse(true, "Berhasil login", 200, ["auth_token" => $token]);
    }

    public function logout(Request $request) {
        $request->user()->currentAccessToken()->delete();
        return $this->generalResponse(true, "Berhasil logout", 200);
    }
}

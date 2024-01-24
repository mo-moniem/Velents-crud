<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Repositories\Contracts\AuthContract;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    public function __construct(public AuthContract $repository)
    {
    }

    public function login(LoginRequest $request)
    {
        $res = $this->repository->login($request->validated());
        return response()->json($res,$res['code']??200);
    }


    public function register(RegisterRequest $request)
    {
        $res = $this->repository->register($request->validated());
        return response()->json($res);
    }

    public function logout(Request $request)
    {
        $res = $this->repository->logout($request);
        return response()->json($res, 200);
    }

    public function profile()
    {
        $res = $this->repository->profile();
        return response()->json($res);
    }
}

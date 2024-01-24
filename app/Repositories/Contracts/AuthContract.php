<?php

namespace App\Repositories\Contracts;

use Illuminate\Http\Request;

interface AuthContract
{
    public function login(Array $data);

    public function register(Array $data);

    public function logout(Request $request);

    public function profile();
}

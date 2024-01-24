<?php

namespace App\Repositories\SQL;

use App\Http\Resources\UserResource;
use App\Models\User;
use App\Repositories\Contracts\AuthContract;
use App\Traits\UploadFile;
use Illuminate\Http\Request;

class AuthRepository implements AuthContract
{
    use UploadFile;
    public function __construct(public User $model)
    {
    }

    public function login(Array $data){
        if (!auth()->attempt($data)) {
            return [
                'status' => false,
                'error_message' => 'Incorrect Details. Please try again',
                'code'=> 401
            ];
        }

        $token = auth()->user()?->createToken(config('app.name'))->accessToken;
        return [
            'status' => true,
            'user' => new UserResource(auth()->user()),
            'token' => $token
        ];
    }

    public function register(Array $data){
        if($data['photo']??''){
            $path = $this->saveFile($data['photo'], 'users');
            $data['photo'] = $path;
        }
        $user = $this->model::create($data);

        $token = $user->createToken('API Token')->accessToken;
        return [
            'status' => true,
            'user' => new UserResource($user),
            'token' => $token
        ];
    }

    public function logout(Request $request){
        $request->user()->token()->revoke();
        return [
            'status' => true,
            'message' => 'Logged out successfully',
        ];
    }

    public function profile(){
        $user = auth()->user();
        return [
            'status' => true,
            'user' => new UserResource($user)
        ];
    }

}

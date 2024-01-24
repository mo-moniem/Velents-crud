<?php

namespace App\Repositories\SQL;

use App\Http\Resources\UserResource;
use App\Models\User;
use App\Repositories\Contracts\UserContract;
use App\Traits\UploadFile;

class UserRepository implements UserContract
{

    use UploadFile;
    /**
     * @param User $model
     */
    public function __construct(public User $model)
    {
    }


    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return UserResource::collection($this->model::all());
    }

    /**
     * @param array $request
     * @return array
     */
    public function store(Array $request)
    {
        if($request['photo']??''){
            $path = $this->saveFile($request['photo'], 'users');
            $request['photo'] = $path;
        }
        $user = $this->model::create($request);
        return ['status' => true, 'user' =>new UserResource($user)];
    }

    /**
     * @param string $id
     * @return array
     */
    public function show(string $id)
    {
        return ['status' => true, 'user' =>new UserResource($this->model::find($id))];
    }

    /**
     * @param array $data
     * @param string $id
     * @return array
     */
    public function update(Array $data, string $id)
    {
        $user = $this->model::find($id);
        if($data['photo']??''){
            $path = $this->saveFile($data['photo'], 'users');
            $data['photo'] = $path;
        }
        $user->update($data);
        return ['status' => true, 'user' =>new UserResource($user->fresh())];
    }

    /**
     * @param string $id
     * @return array
     */
    public function destroy(string $id)
    {
        $user = $this->model::find($id);

        if($user){
            $this->deleteFile($user->photo);
            $user->delete();
        }

        return ['status' => true, 'message' => 'User deleted successfully'];
    }


}

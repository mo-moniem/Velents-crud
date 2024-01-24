<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Repositories\Contracts\UserContract;
use Illuminate\Http\JsonResponse;
class UserController extends Controller
{

    /**
     * @param UserContract $repository
     */
    public function __construct(public UserContract $repository)
    {
        $this->middleware('auth:api')->except(['index', 'show']);
    }


    /**
     * @return JsonResponse
     */
    public function index():JsonResponse
    {
        $users = $this->repository->index();
        return  response()->json(['status' => true, 'users' => $users]);
    }


    /**
     * @param UserRequest $request
     * @return JsonResponse
     */
    public function store(UserRequest $request):JsonResponse
    {
        $res  = $this->repository->store($request->validated());
        return  response()->json($res);
    }


    /**
     * @param string $id
     * @return JsonResponse
     */
    public function show(string $id):JsonResponse
    {
        $res = $this->repository->show($id);
        return  response()->json($res);
    }


    /**
     * @param UserRequest $request
     * @param string $id
     * @return JsonResponse
     */
    public function update(UserRequest $request, string $id):JsonResponse
    {
        $res = $this->repository->update($request->validated(), $id);
        return  response()->json($res);
    }


    /**
     * @param string $id
     * @return JsonResponse
     */
    public function destroy(string $id):JsonResponse
    {
        $res = $this->repository->destroy($id);
        return  response()->json($res);
    }
}

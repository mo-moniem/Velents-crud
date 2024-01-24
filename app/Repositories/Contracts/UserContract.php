<?php

namespace App\Repositories\Contracts;

use App\Models\User;
use Illuminate\Http\Request;

interface UserContract
{

    /**
     * @return mixed
     */
    public function index();

    /**
     * @param array $request
     * @return mixed
     */
    public function store(Array $request);

    /**
     * @param string $id
     * @return mixed
     */
    public function show(string $id);

    /**
     * @param array $data
     * @param string $id
     * @return mixed
     */
    public function update(Array $data, string $id);

    /**
     * @param string $id
     * @return mixed
     */
    public function destroy(string $id);
}

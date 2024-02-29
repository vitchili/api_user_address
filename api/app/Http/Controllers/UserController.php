<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\DeleteUserRequest;
use App\Http\Requests\User\ReadUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{

    protected User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @param ReadUserRequest $request
     * 
     * @return JsonResponse
     */
    public function read(ReadUserRequest $request): JsonResponse
    {
        try {
            return parent::output(
                $this->user->read($request->all())
            , 200);
        } catch (\Throwable $t) {
            Log::error('Error when searching user by params: ' . $t->getMessage());
    
            return response()->json(['message' => 'Error when searching user by params.'], 500);
        }
    }

    /**
     * @param CreateUserRequest $request
     * 
     * @return JsonResponse
     */
    public function create(CreateUserRequest $request): JsonResponse
    {
        try {
            return parent::output(
                User::create($request->all())   
            , 201);
        } catch (\Throwable $t) {
            Log::error('Error when registering user: ' . $t->getMessage());
    
            return response()->json(['message' => 'Error when registering user.'], 500);
        }
    }

    /**
     * @param UpdateUserRequest $request
     * 
     * @return JsonResponse
     */
    public function update(UpdateUserRequest $request): JsonResponse
    {
        try {
            return parent::output(
                User::find($request->id)->update($request->all())
            , 200);
        } catch (\Throwable $t) {
            Log::error('Error when updating user: ' . $t->getMessage());
    
            return response()->json(['message' => 'Error when updating user.'], 500);
        }
    }

    /**
     * @param DeleteUserRequest $request
     * 
     * @return JsonResponse
     */
    public function delete(DeleteUserRequest $request): JsonResponse
    {
        try {
            return parent::output(
                User::find($request->id)->delete()
            , 200);
        } catch (\Throwable $t) {
            Log::error('Error when deleting user: ' . $t->getMessage());
    
            return response()->json(['message' => 'Error when deleting user.'], 500);
        }
    }

}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UserController extends Controller
{
    public function me(Request $request): UserResource
    {
        return new UserResource($request->user());
    }

     /**
      * Returns all users
      */
    public function list_users(): AnonymousResourceCollection
    {
        $users = User::where('state', true)->get();
        return UserResource::collection($users);
    }
}

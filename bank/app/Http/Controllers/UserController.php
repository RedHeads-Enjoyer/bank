<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{
    public function index()
    {
        $user = JWTAuth::parseToken()->authenticate();
        if ($user->role != 1) {
            return response()->json(['data' => "You dont have permissions"], 403);
        }

        $user = UserResource::collection(User::all());
        if ($user->count() > 0)
            return $user;
        else
            return response()->json(['data' => "No users"], 404);
    }


    public function store(UserStoreRequest $request)
    {
        return User::create($request->validated());
    }

    public function show(string $id)
    {
        $current_user = JWTAuth::parseToken()->authenticate();
        if (($current_user->role != 1 && $current_user->id_user != intval($id))) {
            return response()->json(['data' => "You dont have permissions"], 403);
        }

        $user = User::where("id_user", $id)->first();

        if (!$user) {
            return response()->json(['data' => "No such user"], 404);
        }
        return UserResource::make($user);
    }

    public function update(UserStoreRequest $request, string $id)
    {
        $user = JWTAuth::parseToken()->authenticate();
        if ($user->id_user != $id && $user->role != 1) {
            return response()->json(['data' => "You dont have permissions"], 403);
        }

        $user = User::where("id_user", $id)->first();
        if ($user) {
            $user->update($request->validated());
            return UserResource::make($user);
        }
        return response()->json(['data' => "No such user"], 404);
    }

    public function destroy(string $id)
    {
        $user = JWTAuth::parseToken()->authenticate();
        if ($user->role != 1) {
            return response()->json(['data' => "You dont have permissions"], 403);
        }

        $user = User::where("id_user", $id)->first();
        if ($user) {
            $user->delete();
            return response()->json(['data' => "User successfully deleted"], 200);
        }
        return response()->json(['data' => "No such user"], 404);
    }
}

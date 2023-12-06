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
        $user = (new GetAuthUser())->authenticateUser();
        if ($user->status() != 200) return $user;
        $user = $user->getData();

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
        $user = (new GetAuthUser())->authenticateUser();
        if ($user->status() != 200) return $user;
        $user = $user->getData();

        if ($id == 'me') {
            return response()->json(['data' => $user], 200);
        }

        if ($id == 'cookies') {
            return response()->json(['data' => [
                'token' => $_COOKIE['token'],
                'login time' => $_COOKIE['login_time'],
                'ip' => $_COOKIE['ip']
            ]], 200);
        }

        if ($user->role != 1) {
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
        $user = (new GetAuthUser())->authenticateUser();
        if ($user->status() != 200) return $user;
        $user = $user->getData();

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
        $user = (new GetAuthUser())->authenticateUser();
        if ($user->status() != 200) return $user;
        $user = $user->getData();

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

    public function me() {
        return JWTAuth::parseToken()->authenticate();
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = UserResource::collection(User::all());
        if ($user->count() > 0)
            return $user;
        else
            return response()->json(['data' => "No users"], 404);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserStoreRequest $request)
    {
        return User::create($request->validated());
    }

    /**
     * Display the specified resource.
     */
//    public function show(string $id)
//    {
//
//        $user = User::where("id_user", $id)->first();
//        if (!$user) {
//            return response()->json(['data' => "No such user"], 404);
//        }
//        return UserResource::make($user);
//    }

    public function show(string $id)
    {
        $user = JWTAuth::parseToken()->authenticate();
        if ($user->role == 0) {
            return response()->json(['data' => "You dont have permissions"], 403);
        }

        $user = User::where("id_user", $id)->first();
        if (!$user) {
            return response()->json(['data' => "No such user"], 404);
        }
        return UserResource::make($user);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserStoreRequest $request, string $id)
    {
        $user = User::where("id_user", $id)->first();
        if ($user) {
            $user->update($request->validated());
            return UserResource::make($user);
        }
        return response()->json(['data' => "No such user"], 404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::where("id_user", $id)->first();
        if ($user) {
            $user->delete();
            return response()->json(['data' => "User successfully deleted"], 200);
        }
        return response()->json(['data' => "No such user"], 404);
    }
}

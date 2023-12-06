<?php

namespace App\Http\Controllers;

use App\Http\Requests\AccountStoreRequest;
use App\Http\Resources\AccountResource;
use App\Models\Account;
use Tymon\JWTAuth\Facades\JWTAuth;


class AccountController extends Controller
{
    public function index()
    {
        $user = JWTAuth::parseToken()->authenticate();
        if ($user->role != 1) {
            return response()->json(['data' => "You dont have permissions"], 403);
        }

        $account = AccountResource::collection(Account::all());
        if ($account->count() > 0)
            return $account;
        else
            return response()->json(['data' => "No accounts"], 404);
    }

    public function store(AccountStoreRequest $request)
    {
        return Account::create($request->validated());
    }

    public function show(string $id)
    {
        if ($id == 'my') {
            $user = JWTAuth::parseToken()->authenticate();
            $account = Account::where("id_user", $user->id_user)->get();
            return $account;
        }

        $account = Account::where("id_account", $id)->first();

        $user = JWTAuth::parseToken()->authenticate();
        if ($account && $user->role != 1 && $account->id_user != $user->id_user) {
            return response()->json(['data' => "You dont have permissions"], 403);
        }

        if (!$account) {
            return response()->json(['data' => "No such account"], 404);
        }
        return AccountResource::make($account);
//        }
    }

    public function update(AccountStoreRequest $request, string $id)
    {
        $account = Account::where("id_account", $id)->first();

        $user = JWTAuth::parseToken()->authenticate();
        if ($user->role != 1 && $account->id_user != $user->id_user) {
            return response()->json(['data' => "You dont have permissions"], 403);
        }

        if ($account) {
            $account->update($request->validated());
            return AccountResource::make($account);
        }
        return response()->json(['data' => "No such account"], 404);
    }

    public function destroy(string $id)
    {
        $account = Account::where("id_account", $id)->first();

        $user = JWTAuth::parseToken()->authenticate();
        if ($user->role != 1 && $account->id_user != $user->id_user) {
            return response()->json(['data' => "You dont have permissions"], 403);
        }

        if ($account) {
            $account->delete();
            return response()->json(['data' => "Account successfully deleted"], 200);
        }
        return response()->json(['data' => "No such account"], 404);
    }
}

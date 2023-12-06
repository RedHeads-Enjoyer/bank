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
        $user = (new GetAuthUser())->authenticateUser();
        if ($user->status() != 200) return $user;
        $user = $user->getData();

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
        $user = (new GetAuthUser())->authenticateUser();
        if ($user->status() != 200) return $user;
        $user = $user->getData();

        $account = Account::where("id_account", $id)->first();
        if ($account && $user->role != 1) {
            return response()->json(['data' => "You dont have permissions"], 403);
        }

        if (!$account) {
            return response()->json(['data' => "No such account"], 404);
        }
        return AccountResource::make($account);
    }

    public function update(AccountStoreRequest $request, string $id)
    {
        $user = (new GetAuthUser())->authenticateUser();
        if ($user->status() != 200) return $user;
        $user = $user->getData();

        $account = Account::where("id_account", $id)->first();

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
        $user = (new GetAuthUser())->authenticateUser();
        if ($user->status() != 200) return $user;
        $user = $user->getData();

        $account = Account::where("id_account", $id)->first();

        if ($user->role != 1 && $account->id_user != $user->id_user) {
            return response()->json(['data' => "You dont have permissions"], 403);
        }

        if ($account) {
            $account->delete();
            return response()->json(['data' => "Account successfully deleted"], 200);
        }
        return response()->json(['data' => "No such account"], 404);
    }

    public function my() {
        $user = (new GetAuthUser())->authenticateUser();
        if ($user->status() != 200) return $user;
        $user = $user->getData();

        $account = Account::where("id_user", $user->id_user)->get();
        return response()->json(['data' => $account], 200);
    }
}

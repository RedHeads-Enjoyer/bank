<?php

namespace App\Http\Controllers;

use App\Http\Requests\AccountStoreRequest;
use App\Http\Resources\AccountResource;
use App\Models\Account;


class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $account = AccountResource::collection(Account::all());
        if ($account->count() > 0)
            return $account;
        else
            return response()->json(['message' => "No accounts"], 404);
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
    public function store(AccountStoreRequest $request)
    {
        return Account::create($request->validated());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $account = Account::where("id_account", $id)->first();
        if (!$account) {
            return response()->json(['message' => "No such account"], 404);
        }
        return AccountResource::make($account);
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
    public function update(AccountStoreRequest $request, string $id)
    {
        $account = Account::where("id_account", $id)->first();
        $account->update($request->validated());
        return AccountResource::make($account);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $account = Account::where("id_account", $id)->first();
        if ($account) {
            $account->delete();
            return response()->json(['message' => "Account successfully deleted"], 204);
        }
        return response()->json(['message' => "No such account"], 404);
    }
}

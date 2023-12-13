<?php

namespace App\Http\Controllers;

use App\Http\Requests\AccountStoreRequest;
use App\Http\Resources\AccountResource;
use App\Models\Account;
use App\Models\Operation;


class AccountController extends Controller
{
    // Вывод всех пользователей
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

    // Создание пользователя
    public function store(AccountStoreRequest $request)
    {
        return Account::create($request->validated());
    }

    // Получение пользователя по id
    public function show(string $id)
    {
        $user = (new GetAuthUser())->authenticateUser();
        if ($user->status() != 200) return $user;
        $user = $user->getData();

        if ($user->role != 1) {
            return response()->json(['data' => "You dont have permissions"], 403);
        }

        $account = Account::where("id_account", $id)->first();
        if (!$account) {
            return response()->json(['data' => "No such account"], 404);
        }
        return AccountResource::make($account);
    }

    // Изменение пользователя по id
    public function update(AccountStoreRequest $request, string $id)
    {
        $user = (new GetAuthUser())->authenticateUser();
        if ($user->status() != 200) return $user;
        $user = $user->getData();

        $account = Account::where("id_account", $id)->first();

        if ($user->role != 1) {
            return response()->json(['data' => "You dont have permissions"], 403);
        }

        if ($account) {
            $account->update($request->validated());
            return AccountResource::make($account);
        }
        return response()->json(['data' => "No such account"], 404);
    }

    // Удаление пользователя по id
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

    public function send(string $id_from, string $id_to, string $sum) {
        $user = (new GetAuthUser())->authenticateUser();
        if ($user->status() != 200) return $user;
        $user = $user->getData();

        $account_from = Account::where("id_account", $id_from)->first();
        if ($account_from && $account_from->id_user != $user->id_user) {
            return response()->json(['data' => "You dont have permissions"], 403);
        }

        $account_to = Account::where("id_account", $id_to)->first();
        if (!$account_to) {
            return response()->json(['data' => "Target account not found"], 403);
        }

        if ($account_to->id_currency != $account_from->id_currency) {
            return response()->json(['data' => "The account currencies do not match"], 403);
        }

        if (doubleval($sum) <= 0) {
            return response()->json(['data' => "Sum must be greater then 0"], 403);
        }

        if ($account_from->balance < doubleval($sum)) {
            return response()->json(['data' => "You dont have enough money"], 403);
        }

        Account::where("id_account", $account_from)->update(['balance' =>  $account_from->balance - doubleval($sum)]);
        Account::where("id_account", $account_to)->update(['balance' =>  $account_to->balance + doubleval($sum)]);

        Operation::create([
            'delta' => -1 * doubleval($sum),
            'date' => now()->format('Y-m-d H:i:s'),
            'id_account' => $account_from->id_account
        ]);

        Operation::create([
            'delta' => doubleval($sum),
            'date' => now()->format('Y-m-d H:i:s'),
            'id_account' => $account_to->id_account
        ]);

        return response()->json(['data' => "Operation are complited"], 403);
    }

    // Получение пользователя с переданным токеном
    public function my() {
        $user = (new GetAuthUser())->authenticateUser();
        if ($user->status() != 200) return $user;
        $user = $user->getData();

        $account = Account::where("id_user", $user->id_user)->get();
        return response()->json(['data' => $account], 200);
    }
}

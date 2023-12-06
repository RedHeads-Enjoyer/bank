<?php

namespace App\Http\Controllers;

use App\Http\Requests\CardStoreRequest;
use App\Http\Resources\CardResource;
use App\Models\Account;
use App\Models\Card;
use Tymon\JWTAuth\Facades\JWTAuth;

class CardController extends Controller
{
    public function index()
    {
        $user = (new GetAuthUser())->authenticateUser();
        if ($user->status() != 200) return $user;
        $user = $user->getData();

        if ($user->role != 1) {
            return response()->json(['data' => "You dont have permissions"], 403);
        }

        $card = CardResource::collection(Card::all());
        if ($card->count() > 0) {
            return $card;
        }
        return response()->json(['data' => "No cards"], 404);
    }

    public function store(CardStoreRequest $request)
    {
        return Card::create($request->validated());
    }

    public function show(string $id)
    {
        $user = (new GetAuthUser())->authenticateUser();
        if ($user->status() != 200) return $user;
        $user = $user->getData();

        if ($id == 'my') {
            $cards = Card::join('accounts', 'accounts.id_account', '=', 'cards.id_account')
                ->where('accounts.id_user', $user->id_user)->select('cards.id_card', 'cards.number', 'cards.cvc')->get();
            return response()->json(['data' => $cards], 200);
        }

        $card = Card::where("id_card", $id)->first();
        $account = Account::where($card->id_accaunt, $id)->first();

        if ($user->role != 1 && $account->id_user != $user->id_user) {
            return response()->json(['data' => "You dont have permissions"], 403);
        }

        if (!$card) {
            return response()->json(['data' => "No such card"], 404);
        }
        return CardResource::make($card);
    }

    public function update(CardStoreRequest $request, string $id)
    {
        $user = (new GetAuthUser())->authenticateUser();
        if ($user->status() != 200) return $user;
        $user = $user->getData();

        $card = Card::where("id_card", $id)->first();
        $account = Account::where($card->id_accaunt, $id)->first();

        if ($user->role != 1 && $account->id_user != $user->id_user) {
            return response()->json(['data' => "You dont have permissions"], 403);
        }

        if ($card) {
            $card->update($request->validated());
            return CardResource::make($card);
        }
        return response()->json(['data' => "No such card"], 404);
    }

    public function destroy(string $id)
    {
        $card = Card::where("id_card", $id)->first();
        $account = Account::where($card->id_accaunt, $id)->first();

        $user = JWTAuth::parseToken()->authenticate();
        if ($user->role != 1 && $account->id_user != $user->id_user) {
            return response()->json(['data' => "You dont have permissions"], 403);
        }

        if ($card) {
            $card->delete();
            return response()->json(['data' => "Card successfully deleted"], 204);
        }
        return response()->json(['data' => "No such card"], 404);
    }
}

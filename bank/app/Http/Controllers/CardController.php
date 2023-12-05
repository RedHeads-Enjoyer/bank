<?php

namespace App\Http\Controllers;

use App\Http\Requests\CardStoreRequest;
use App\Http\Resources\CardResource;
use App\Models\Card;
use Tymon\JWTAuth\Facades\JWTAuth;

class CardController extends Controller
{
    public function index()
    {
        $card = CardResource::collection(Card::all());
        if ($card->count() > 0)
            return $card;
        else
            return response()->json(['data' => "No cards"], 404);
    }

    public function store(CardStoreRequest $request)
    {
        return Card::create($request->validated());
    }

    public function show(string $id)
    {
        $card = Card::where("id_card", $id)->first();

        if (!$card) {
            return response()->json(['data' => "No such card"], 404);
        }
        return CardResource::make($card);
    }

    public function update(CardStoreRequest $request, string $id)
    {
        $user = JWTAuth::parseToken()->authenticate();
        if ($user->role != 1) {
            return response()->json(['data' => "You dont have permissions"], 403);
        }
        $card = Card::where("id_card", $id)->first();
        if ($card) {
            $card->update($request->validated());
            return CardResource::make($card);
        }
        return response()->json(['data' => "No such card"], 404);
    }

    public function destroy(string $id)
    {
        $user = JWTAuth::parseToken()->authenticate();
        if ($user->role != 1) {
            return response()->json(['data' => "You dont have permissions"], 403);
        }
        $card = Card::where("id_card", $id)->first();
        if ($card) {
            $card->delete();
            return response()->json(['data' => "Card successfully deleted"], 204);
        }
        return response()->json(['data' => "No such card"], 404);
    }
}

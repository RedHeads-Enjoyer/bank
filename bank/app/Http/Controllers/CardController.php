<?php

namespace App\Http\Controllers;

use App\Http\Requests\CardStoreRequest;
use App\Http\Resources\CardResource;
use App\Models\Card;

class CardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $card = CardResource::collection(Card::all());
        if ($card->count() > 0)
            return $card;
        else
            return response()->json(['data' => "No cards"], 404);
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
    public function store(CardStoreRequest $request)
    {
        return Card::create($request->validated());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $card = Card::where("id_card", $id)->first();
        if (!$card) {
            return response()->json(['data' => "No such card"], 404);
        }
        return CardResource::make($card);
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
    public function update(CardStoreRequest $request, string $id)
    {
        $card = Card::where("id_card", $id)->first();
        if ($card) {
            $card->update($request->validated());
            return CardResource::make($card);
        }
        return response()->json(['data' => "No such card"], 404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $card = Card::where("id_card", $id)->first();
        if ($card) {
            $card->delete();
            return response()->json(['data' => "Card successfully deleted"], 204);
        }
        return response()->json(['data' => "No such card"], 404);
    }
}

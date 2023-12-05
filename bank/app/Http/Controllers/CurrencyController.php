<?php

namespace App\Http\Controllers;


use App\Http\Requests\CurrencyStoreRequest;
use App\Http\Resources\CurrencyResource;
use App\Models\Currency;
use Tymon\JWTAuth\Facades\JWTAuth;

class CurrencyController extends Controller
{
    public function index()
    {
        $user = JWTAuth::parseToken()->authenticate();
        if ($user->role != 1) {
            return response()->json(['data' => "You dont have permissions"], 403);
        }

        $currency = CurrencyResource::collection(Currency::all());
        if ($currency->count() > 0)
            return $currency;
        else
            return response()->json(['data' => "No currencies"], 404);
    }

    public function store(CurrencyStoreRequest $request)
    {
        return Currency::create($request->validated());
    }

    public function show(string $id)
    {
        $currency = Currency::where("id_currency", $id)->first();
        if (!$currency) {
            return response()->json(['data' => "No such currency"], 404);
        }
        return CurrencyResource::make($currency);
    }

    public function update(CurrencyStoreRequest $request, string $id)
    {
        $currency = Currency::where("id_currency", $id)->first();
        if ($currency) {
            $currency->update($request->validated());
            return CurrencyResource::make($currency);
        }
        return response()->json(['data' => "No such deleted"], 404);
    }

    public function destroy(string $id)
    {
        $currency = Currency::where("id_currency", $id)->first();
        if ($currency) {
            $currency->delete();
            return response()->json(['data' => "Currency successfully deleted"], 200);
        }
        return response()->json(['data' => "No such currency"], 404);
    }
}

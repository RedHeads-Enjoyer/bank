<?php

namespace App\Http\Controllers;


use App\Http\Requests\OperaionStoreRequest as OperaionStoreRequestAlias;
use App\Http\Resources\CurrencyResource;
use App\Models\Currency;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $currency = CurrencyResource::collection(Currency::all());
        if ($currency->count() > 0)
            return $currency;
        else
            return response()->json(['message' => "No currencies"], 404);
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
    public function store(OperaionStoreRequestAlias $request)
    {
        return Currency::create($request->validated());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $currency = Currency::where("id_currency", $id)->first();
        if (!$currency) {
            return response()->json(['message' => "No such currency"], 404);
        }
        return CurrencyResource::make($currency);
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
    public function update(OperaionStoreRequestAlias $request, string $id)
    {
        $currency = Currency::where("id_currency", $id)->first();
        $currency->update($request->validated());
        return CurrencyResource::make($currency);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $currency = Currency::where("id_currency", $id)->first();
        if ($currency) {
            $currency->delete();
            return response()->json(['message' => "Currency successfully deleted"], 204);
        }
        return response()->json(['message' => "No such currency"], 404);
    }
}

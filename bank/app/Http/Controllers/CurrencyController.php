<?php

namespace App\Http\Controllers;


use App\Http\Requests\CurrencyStoreRequest;
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
            return response()->json(['data' => "No currencies"], 404);
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
    public function store(CurrencyStoreRequest $request)
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
            return response()->json(['data' => "No such currency"], 404);
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
    public function update(CurrencyStoreRequest $request, string $id)
    {
        $currency = Currency::where("id_currency", $id)->first();
        if ($currency) {
            $currency->update($request->validated());
            return CurrencyResource::make($currency);
        }
        return response()->json(['data' => "No such deleted"], 404);
    }

    /**
     * Remove the specified resource from storage.
     */
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

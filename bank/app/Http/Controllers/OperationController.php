<?php

namespace App\Http\Controllers;

use App\Http\Requests\OperaionStoreRequest;
use App\Http\Resources\OperationResource;
use App\Models\Operation;

class OperationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $operation = OperationResource::collection(Operation::all());
        if ($operation->count() > 0)
            return $operation;
        else
            return response()->json(['data' => "No operations"], 404);
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
    public function store(OperaionStoreRequest $request)
    {
        return Operation::create($request->validated());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $operation = Operation::where("id_operation", $id)->first();
        if (!$operation) {
            return response()->json(['data' => "No such operation"], 404);
        }
        return OperationResource::make($operation);
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
    public function update(OperaionStoreRequest $request, string $id)
    {
        $operation = Operation::where("id_operation", $id)->first();
        if ($operation) {
            $operation->update($request->validated());
            return OperationResource::make($operation);
        }
        return response()->json(['data' => "No such operation"], 404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $operation = Operation::where("id_operation", $id)->first();
        if ($operation) {
            $operation->delete();
            return response()->json(['data' => "Operation successfully deleted"], 204);
        }
        return response()->json(['data' => "No such operation"], 404);
    }
}

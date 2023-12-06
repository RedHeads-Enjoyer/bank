<?php

namespace App\Http\Controllers;

use App\Http\Requests\OperaionStoreRequest;
use App\Http\Resources\OperationResource;
use App\Models\Account;
use App\Models\Operation;
use Tymon\JWTAuth\Facades\JWTAuth;

class OperationController extends Controller
{
    public function index()
    {
        $user = (new GetAuthUser())->authenticateUser();
        if ($user->status() != 200) return $user;
        $user = $user->getData();

        if ($user->role != 1) {
            return response()->json(['data' => "You dont have permissions"], 403);
        }

        $operation = OperationResource::collection(Operation::all());
        if ($operation->count() > 0)
            return $operation;
        else
            return response()->json(['data' => "No operations"], 404);
    }

    public function store(OperaionStoreRequest $request)
    {
        $user = (new GetAuthUser())->authenticateUser();
        if ($user->status() != 200) return $user;
        $user = $user->getData();

        $validatedData = $request->validated();
        $account = Account::where("id_account", $validatedData['id_account'])->first();

        if ($account && $account->id_user == $user->id_user) {
            $validatedData['date'] = now()->format('Y-m-d H:i:s');
            return Operation::create($validatedData);
        }

        return response()->json(['data' => "You dont have permissions"], 403);
    }

    public function show(string $id)
    {
        $user = (new GetAuthUser())->authenticateUser();
        if ($user->status() != 200) return $user;
        $user = $user->getData();

        $operation = Operation::where("id_operation", $id)->first();

        if ($user->role != 1) {
            return response()->json(['data' => "You dont have permissions"], 403);
        }

        if (!$operation) {
            return response()->json(['data' => "No such operation"], 404);
        }
        return OperationResource::make($operation);
    }

    public function update(OperaionStoreRequest $request, string $id)
    {
        $user = (new GetAuthUser())->authenticateUser();
        if ($user->status() != 200) return $user;
        $user = $user->getData();

        if ($user->role != 1) {
            return response()->json(['data' => "You dont have permissions"], 403);
        }

        $operation = Operation::where("id_operation", $id)->first();
        if ($operation) {
            $operation->update($request->validated());
            return OperationResource::make($operation);
        }
        return response()->json(['data' => "No such operation"], 404);
    }

    public function destroy(string $id)
    {
        $user = (new GetAuthUser())->authenticateUser();
        if ($user->status() != 200) return $user;
        $user = $user->getData();

        if ($user->role != 1) {
            return response()->json(['data' => "You dont have permissions"], 403);
        }

        $operation = Operation::where("id_operation", $id)->first();
        if ($operation) {
            $operation->delete();
            return response()->json(['data' => "Operation successfully deleted"], 204);
        }
        return response()->json(['data' => "No such operation"], 404);
    }
}

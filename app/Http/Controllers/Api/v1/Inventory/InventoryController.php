<?php

namespace App\Http\Controllers\Api\v1\Inventory;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\Inventory\StoreInventoryRequest;
use App\Http\Requests\Api\v1\Inventory\UpdateInventoryRequest;
use App\Models\ApiResponse;
use App\Models\Inventory;


class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Inventory::class);

        return ApiResponse::success(['inventories' => Inventory::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInventoryRequest $request)
    {
        $this->authorize('create', Inventory::class);

        $inventory = Inventory::create($request->all());

        return ApiResponse::success(['inventory' => $inventory]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Inventory $inventory)
    {
        $this->authorize('view', Inventory::class);

        return ApiResponse::success(['inventory' => $inventory]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInventoryRequest $request, Inventory $inventory)
    {
        $this->authorize('update', Inventory::class);

        $inventory->update($request->all());

        return ApiResponse::success(['inventory' => $inventory]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Inventory $inventory)
    {
        $this->authorize('delete', Inventory::class);

        $inventory->delete();

        return ApiResponse::success(null, 204);
    }
}
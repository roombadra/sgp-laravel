<?php

namespace App\Http\Controllers\Api\v1\Organism;

use App\Models\Organism;
use App\Models\ApiResponse;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\Organism\OrganismRequest;

class OrganismController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Organism::class);

        return ApiResponse::success(['organisms' => Organism::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrganismRequest $request)
    {
        $this->authorize('create', Organism::class);

        $request['name'] = Str::upper($request['name']);

        $organism = Organism::create($request->all());

        return ApiResponse::success(['organism' => $organism]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Organism $organism)
    {
        $this->authorize('view', Organism::class);

        return ApiResponse::success(['organism' => $organism]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(OrganismRequest $request, Organism $organism)
    {
        $this->authorize('update', Organism::class);

        $request['name'] = Str::upper($request['name']);

        $organism->update($request->all());
        return ApiResponse::success(['organism' => $organism]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Organism $organism)
    {
        $this->authorize('delete', Organism::class);

        $organism->delete();
        return ApiResponse::success(null, 204);
    }
}
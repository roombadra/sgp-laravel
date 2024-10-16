<?php

namespace App\Http\Controllers\Api\v1\Projet;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\Projet\StoreProjetRequest;
use App\Http\Requests\Api\v1\Projet\UpdateProjetRequest;
use App\Models\ApiResponse;
use App\Models\Projet;
use Illuminate\Http\Request;

class ProjetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Projet::class);

        return ApiResponse::success(['projets' => Projet::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjetRequest $request)
    {
        $this->authorize('create', Projet::class);

        $projet = Projet::create($request->all());
        return ApiResponse::success(['projet' => $projet]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Projet $projet)
    {
        $this->authorize('view', Projet::class);

        return ApiResponse::success(['projet' => $projet]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjetRequest $request, Projet $projet)
    {
        $this->authorize('update', Projet::class);

        $projet->update($request->all());
        return ApiResponse::success(['projet' => $projet]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Projet $projet)
    {
        $this->authorize('delete', Projet::class);

        $projet->delete();
        return ApiResponse::success(null, 204);
    }
}
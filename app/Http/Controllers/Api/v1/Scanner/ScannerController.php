<?php

namespace App\Http\Controllers\Api\v1\Scanner;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\Scanner\StorecannerRequest;
use App\Http\Requests\Api\v1\Scanner\UpdateScannerRequest;
use App\Models\ApiResponse;
use App\Models\Scanner;
use Illuminate\Http\Request;

class ScannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Scanner::class);

        return ApiResponse::success(['scanners' => Scanner::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorecannerRequest $request)
    {
        $this->authorize('create', Scanner::class);

        $scanner = Scanner::create($request->all());
        return ApiResponse::success(['scanner' => $scanner]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Scanner $scanner)
    {
        $this->authorize('view', Scanner::class);

        return ApiResponse::success(['scanner' => $scanner]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateScannerRequest $request, Scanner $scanner)
    {
        $this->authorize('update', Scanner::class);

        $scanner->update($request->all());
        return ApiResponse::success(['scanner' => $scanner]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Scanner $scanner)
    {
        $this->authorize('delete', Scanner::class);

        $scanner->delete();
        return ApiResponse::success($scanner);
    }
}
<?php

namespace App\Http\Controllers\Api\v1\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\User\StoreUserRequest;
use App\Http\Requests\Api\v1\User\UpdateUserRequest;
use App\Models\ApiResponse;
use App\Models\User;
use Log;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', User::class);

        return ApiResponse::success(['users' => User::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $this->authorize('create', User::class);

        $request['password'] = bcrypt($request->password);
        $user = User::create($request->all());
        Log::channel('user')->info('Utilisateur créé', [
            'user' => $user->email,
            'created by' => auth()->user()->email,
        ]);
        return ApiResponse::success(['user' => $user]);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $this->authorize('view', User::class);

        return ApiResponse::success(['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $this->authorize('update', User::class);

        $request['password'] = bcrypt($request['password']);

        if (User::where('email', $request->email)->exists()) {
            $user->update($request->except('email'));
            Log::channel('user')->info('Utilisateur modifié', [
                'user' => $user->email,
                'updated by' => auth()->user()->email,
            ]);
            return ApiResponse::success(['user' => $user]);
        } else {
            $user->update($request->all());
            Log::channel('user')->info('Utilisateur modifié', [
                'user' => $user->email,
                'updated by' => auth()->user()->email,
            ]);
            return ApiResponse::success(['user' => $user]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $this->authorize('delete', User::class);
        $user->delete();
        Log::channel('user')->warning('Utilisaateur supprimé', [
            'user' => $user->email,
            'deleted by' => auth()->user()->email,
            'his ip' => request()->ip(),
        ]);
        return ApiResponse::success(null, 204);
    }
}
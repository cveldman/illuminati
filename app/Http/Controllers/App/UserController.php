<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;

class UserController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(User::class);
    }

    public function index()
    {
        $users = UserResource::collection(User::all());

        return inertia('Users/Index', compact('users'));
    }

    public function create()
    {
        return inertia('Users/Create');
    }

    public function store(StoreUserRequest $request)
    {
        User::create($request->validated());

        return to_route('users.index');
    }

    public function show(User $user)
    {
        return inertia('Users/Show', ['user' => new UserResource($user)]);
    }

    public function edit(User $user)
    {
        return inertia('Users/Edit', ['user' => new UserResource($user)]);
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->validated());

        return to_route('users.index');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return to_route('users.index');
    }
}

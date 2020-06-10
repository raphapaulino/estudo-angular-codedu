<?php

namespace App\Http\Controllers\Api;

use App\Common\OnlyTrashed;
use App\Events\UserCreatedEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\Company;
use App\Models\User;
use App\Models\UserTenant;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    use OnlyTrashed;
    
    public function index(Request $request)
    {
        $query = User::query();
        $query = $this->onlyTrashedIfRequested($request, $query);
        $users = $query->paginate();
        return UserResource::collection($users);
    }

    public function store(UserRequest $request)
    {
        \Tenant::setTenant(Company::find(3));
        $tenant = \Tenant::getTenant();

        $attributes = $request->all();
        $attributes['company_id'] = $tenant->id;
        $userTenant = new UserTenant;
        $newUserTenant = $userTenant->createUser(['user' => $attributes]);

        event(new UserCreatedEvent($newUserTenant->user));

        return new UserResource($newUserTenant->user);
    }

    public function show(User $user)
    {
        return new UserResource($user);
    }

    public function update(UserRequest $request, User $user)
    {
        $user->fill($request->all());
        $user->save();

        return new UserResource($user);
    }

    public function destroy(User $user)
    {
        $user->delete();
        return response()->json([], 204);
    }
}

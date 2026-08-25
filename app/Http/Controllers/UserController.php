<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\GhorfeOnlineList;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * GET /api/ghorfes/{ghorfe}/users
     *
     * Returns paginated users assigned to a ghorfe.
     */
    public function index(Request $request, GhorfeOnlineList $ghorfe)
    {
        $users = $ghorfe->users()->paginate($request->integer('per_page', 15));

        return UserResource::collection($users);
    }

    /**
     * GET /api/ghorfes/{ghorfe}/users/{user}
     *
     * Returns one user only if they belong to this ghorfe.
     */
    public function show(GhorfeOnlineList $ghorfe, User $user)
    {
        $user = $ghorfe->users()
            ->whereKey($user->id)
            ->firstOrFail();

        return new UserResource($user);
    }

}

<?php

namespace App\Http\Controllers;

use App\Http\Resources\CallCenterResource;
use App\Models\Callcenter;
use App\Models\GhorfeOnlineList;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CallCenterController extends Controller
{
    public function index(GhorfeOnlineList $ghorfe)
    {
        $callCenters = $ghorfe->callCenters()
            ->with(['reason', 'user', 'agent'])
            ->latest('id')
            ->paginate();

        return CallCenterResource::collection($callCenters);
    }

    public function store(Request $request, GhorfeOnlineList $ghorfe)
    {
        $data = $request->validate([
            'name' => ['nullable', 'string', 'max:255'],
            'family' => ['nullable', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'agent_id' => ['nullable', 'integer', 'exists:users,id'],
            'type' => ['required', 'integer'],
            'request_type' => ['required', 'string', 'max:11'],
            'status' => ['required', 'integer'],
            'description' => ['nullable', 'string'],
            'reason_id' => ['nullable', 'integer'],
        ]);

        $callCenter = DB::transaction(function () use ($data, $ghorfe) {
            $user = User::updateOrCreate(
                ['phone' => $data['phone']],
                [
                    'name' => $data['name'] ?? null,
                    'family' => $data['family'] ?? null,
                ]
            );

            $callCenter = CallCenter::create([
                'user_id' => $user->id,
                'agent_id' => $data['agent_id'] ?? null,
                'type' => $data['type'],
                'request_type' => $data['request_type'],
                'status' => $data['status'],
                'description' => $data['description'] ?? null,
                'reason_id' => $data['reason_id'] ?? null,
            ]);

            $ghorfe->callCenters()->attach($callCenter->id);

            return $callCenter;
        });

        $callCenter->load(['reason', 'user', 'agent']);

        return response()->json([
            'message' => 'Call center and user created successfully.',
            'data' => new CallCenterResource($callCenter),
        ], 201);
    }

}

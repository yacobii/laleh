<?php

namespace App\Http\Controllers;

use App\Http\Resources\CallCenterResource;
use App\Models\GhorfeOnlineList;
use Illuminate\Http\Request;

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
}

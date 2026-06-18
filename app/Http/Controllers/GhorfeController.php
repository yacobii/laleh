<?php

namespace App\Http\Controllers;

use App\Http\Resources\GhorfeResource;
use App\Models\GhorfeOnlineList;

class GhorfeController extends Controller
{
    public function ghorfes()
    {
        $ghorfes = GhorfeOnlineList::with([
            'services.centers',
            'services.financialPlansTypes',
            'products.categories',
            'users'
        ])->paginate(10);

        return GhorfeResource::collection($ghorfes);
    }

    public function ghorfe(GhorfeOnlineList $ghorfe)
    {
        $ghorfe->load([
            'services.centers',
            'services.financialPlansTypes',
            'products.categories',
            'users'
        ]);

        return new GhorfeResource($ghorfe);
    }
}

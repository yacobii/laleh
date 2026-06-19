<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArticleResource;
use App\Http\Resources\GhorfeResource;
use App\Http\Resources\ServiceResource;
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
            'articles.category_article', // Load article categories
            'users'
        ]);
        return new GhorfeResource($ghorfe);
    }

    public function ghorfeServices(GhorfeOnlineList $ghorfe)
    {
        $services = $ghorfe->services()
            ->with(['centers', 'financialPlansTypes'])
            ->paginate();

        return ServiceResource::collection($services);
    }

    /**
     * GET /api/ghorfes/{id}/articles
     */
    public function ghorfeArticles(GhorfeOnlineList $ghorfe)
    {
        $articles = $ghorfe->articles()
            ->with('category_article')
            ->latest()
            ->paginate();

        return ArticleResource::collection($articles);
    }
}

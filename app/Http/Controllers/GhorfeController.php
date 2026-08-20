<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArticleResource;
use App\Http\Resources\GalleryResource;
use App\Http\Resources\GhorfeResource;
use App\Http\Resources\ServiceResource;
use App\Models\GhorfeOnlineList;
use Illuminate\Http\Request;

class GhorfeController extends Controller
{
    public function ghorfes(Request $request)
    {
        $slug = $request->header('X-Ghorfe-Slug');

        //        $ghorfes = GhorfeOnlineList::with([
        //            'services.centers',
        //            'services.financialPlansTypes',
        //            'products.categories',
        //            'users',
        //        ])->paginate(10);
        $query = GhorfeOnlineList::with([
            'services.centers',
            'services.financialPlansTypes',
            'products.categories',
            'users',
        ]);
        if ($slug) {
            $ghorfe = $query->where('slug', $slug)->firstOrFail();

            // Return a single resource
            return new GhorfeResource($ghorfe);
        }
        $ghorfes = $query->paginate(10);

        return GhorfeResource::collection($ghorfes);
    }

    public function ghorfe(GhorfeOnlineList $ghorfe)
    {
        $ghorfe->load([
            'services.centers',
            'services.financialPlansTypes',
            'products.categories',
            'articles.category_article',
            'galleries',
            'users',
            'callCenters.reason',
            'callCenters.user',
            'callCenters.agent',
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

    public function ghorfeGalleries(GhorfeOnlineList $ghorfe)
    {
        $galleries = $ghorfe->galleries()->latest()->paginate();

        return GalleryResource::collection($galleries);
    }
}

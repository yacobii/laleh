<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArticleResource;
use App\Http\Resources\GalleryResource;
use App\Http\Resources\GhorfeResource;
use App\Http\Resources\ServiceResource;
use App\Models\GhorfeOnlineList;
use App\Models\Service;
use Illuminate\Http\Request;

class GhorfeController extends Controller
{
    public function ghorfes(Request $request)
    {
        $domain = $request->header('X-Ghorfe-Domain');

        $query = GhorfeOnlineList::with([
            'services.centers',
            'services.financialPlansTypes',
            'products.categories',
            'users',
        ]);

        if ($domain) {
            return new GhorfeResource(
                $query->where('domain_active', $domain)->firstOrFail()
            );
        }

        return GhorfeResource::collection($query->paginate(10));
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

    public function ghorfeService(GhorfeOnlineList $ghorfe, int $service)
    {
        $service = $ghorfe->services()
            ->with(['centers', 'financialPlansTypes'])
            ->where('services.id', $service)
            ->firstOrFail();

        return new ServiceResource($service);
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

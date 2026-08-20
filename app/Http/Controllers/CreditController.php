<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArticleResource;
use App\Http\Resources\CreditResource;
use App\Models\a\Article;

class CreditController extends Controller
{
    public function credits()
    {
        return CreditResource::collection(Article::query()
            ->with('category_article')
            ->latest()->simplePaginate());
    }

    public function article(Article $article)
    {
        $article->load('category_article');

        return new ArticleResource($article);
    }
}

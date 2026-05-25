<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArticleResource;
use App\Models\a\Article;

class ArticleController extends Controller
{
    public function articles()
    {
        return ArticleResource::collection(Article::query()
            ->with('category_article')
            ->latest()->paginate());
    }

    public function article(Article $article)
    {
        $article->load('category_article');
        return new ArticleResource($article);
    }
}

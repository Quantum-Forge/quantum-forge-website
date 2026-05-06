<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $articles = Article::query()
            ->where('status', Article::STATUS_PUBLISHED)
            ->orderByDesc('published_at')
            ->orderByDesc('id')
            ->paginate(10);

        return view('articles', [
            'articles' => $articles,
        ]);
    }

    public function show(Article $article)
    {
        abort_unless($article->status === Article::STATUS_PUBLISHED, 404);

        $relatedArticles = Article::query()
            ->where('status', Article::STATUS_PUBLISHED)
            ->whereKeyNot($article->id)
            ->orderByDesc('published_at')
            ->orderByDesc('id')
            ->limit(2)
            ->get();

        return view('details.articles', [
            'article' => $article,
            'relatedArticles' => $relatedArticles,
        ]);
    }
}


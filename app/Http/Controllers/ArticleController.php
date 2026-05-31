<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $categorySlug = $request->input('category');

        $articles = Article::query()
            ->with('category')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->when($search, function ($query, $search) {
                return $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                        ->orWhere('content', 'like', "%{$search}%");
                });
            })
            ->when($categorySlug, function ($query, $categorySlug) {
                return $query->whereHas('category', function ($q) use ($categorySlug) {
                    $q->where('slug', $categorySlug);
                });
            })
            ->latest('published_at')
            ->paginate(10)
            ->withQueryString();

        return view('articles', compact('articles', 'search', 'categorySlug'));
    }

    public function show(Article $article)
    {
        if (! $article->published_at || $article->published_at->isFuture()) {
            abort(404);
        }

        // For the sidebar or related posts
        $relatedArticles = Article::query()
            ->with('category')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->whereKeyNot($article->id)
            ->when($article->category_id, fn ($q) => $q->where('category_id', $article->category_id))
            ->latest('published_at')
            ->take(2)
            ->get();
        return view('details.articles', compact('article', 'relatedArticles'));
    }
}

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

        $articles = Article::when($search, function ($query, $search) {
            return $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        })
        ->when($categorySlug, function ($query, $categorySlug) {
            return $query->whereHas('category', function ($q) use ($categorySlug) {
                $q->where('slug', $categorySlug);
            });
        })
        ->latest()
        ->paginate(5)
        ->withQueryString();

        return view('articles', compact('articles', 'search', 'categorySlug'));
    }

    public function show(Article $article)
    {
        // For the sidebar or related posts
        $relatedArticles = Article::where('id', '!=', $article->id)->latest()->take(2)->get();
        return view('details.articles', compact('article', 'relatedArticles'));
    }
}

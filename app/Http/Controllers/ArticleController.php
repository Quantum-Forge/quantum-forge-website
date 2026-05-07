<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::latest()->paginate(6);
        return view('articles', compact('articles'));
    }

    public function show(Article $article)
    {
        // For the sidebar or related posts
        $relatedArticles = Article::where('id', '!=', $article->id)->latest()->take(2)->get();
        return view('details.articles', compact('article', 'relatedArticles'));
    }
}

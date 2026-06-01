<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $newsQuery = Article::query()
            ->whereNotNull('image_url')
            ->where('image_url', '!=', '');

        if (Schema::hasColumn('articles', 'published_at')) {
            $newsQuery->orderByDesc('published_at');
        }

        $newsQuery->orderByDesc('created_at');

        if (Schema::hasColumn('articles', 'category_id')) {
            $newsQuery->with('category:id,name');
        }

        $newsArticles = $newsQuery->take(3)->get();

        foreach ($newsArticles as $article) {
            $rawImageUrl = (string) ($article->image_url ?? '');

            if ($rawImageUrl === '') {
                $imageSrc = asset('images/logo.png');
            } elseif (preg_match('#^https?://#i', $rawImageUrl)) {
                $imageSrc = $rawImageUrl;
            } else {
                $imageSrc = asset('storage/' . ltrim($rawImageUrl, '/'));
            }

            $categoryLabel = (string) ($article->getAttribute('category') ?? '');
            if ($categoryLabel === '' && $article->relationLoaded('category')) {
                $categoryLabel = (string) ($article->category->name ?? '');
            }
            if ($categoryLabel === '') {
                $categoryLabel = 'Uncategorized';
            }

            $article->setAttribute('news_url', route('articles.details', $article->slug));
            $article->setAttribute('news_image_src', $imageSrc);
            $article->setAttribute('news_category_label', $categoryLabel);
            $article->setAttribute('news_title_short', Str::limit((string) ($article->title ?? ''), 48));
            $article->setAttribute('news_published_at', $article->published_at ?: $article->created_at);
        }

        return view('home', compact('newsArticles'));
    }
}

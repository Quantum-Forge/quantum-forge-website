<?php

namespace Tests\Feature;

use App\Models\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomeNewsSectionTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_news_section_renders_articles_from_database(): void
    {
        Article::query()->create([
            'title' => 'Artikel Satu',
            'slug' => 'artikel-satu',
            'content' => 'Konten satu',
            'image_url' => 'images/article-1.jpg',
            'published_at' => now()->subDays(3),
        ]);

        Article::query()->create([
            'title' => 'Artikel Dua',
            'slug' => 'artikel-dua',
            'content' => 'Konten dua',
            'image_url' => 'images/article-2.jpg',
            'published_at' => now()->subDays(2),
        ]);

        Article::query()->create([
            'title' => 'Artikel Tiga',
            'slug' => 'artikel-tiga',
            'content' => 'Konten tiga',
            'image_url' => 'images/article-3.jpg',
            'published_at' => now()->subDay(),
        ]);

        $response = $this->get('/');

        $response->assertOk();
        $response->assertSee('Artikel Satu');
        $response->assertSee('Artikel Dua');
        $response->assertSee('Artikel Tiga');
        $response->assertSee(route('articles.details', 'artikel-satu'));
        $response->assertSee(route('articles.details', 'artikel-dua'));
        $response->assertSee(route('articles.details', 'artikel-tiga'));
        $response->assertSee('storage/images/article-1.jpg');
        $response->assertSee('storage/images/article-2.jpg');
        $response->assertSee('storage/images/article-3.jpg');
    }
}


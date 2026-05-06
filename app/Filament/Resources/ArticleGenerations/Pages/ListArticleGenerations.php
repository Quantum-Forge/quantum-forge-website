<?php

namespace App\Filament\Resources\ArticleGenerations\Pages;

use App\Filament\Resources\ArticleGenerations\ArticleGenerationResource;
use Filament\Resources\Pages\ListRecords;

class ListArticleGenerations extends ListRecords
{
    protected static string $resource = ArticleGenerationResource::class;
}


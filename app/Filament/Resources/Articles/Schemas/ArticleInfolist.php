<?php

namespace App\Filament\Resources\Articles\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ArticleInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Artikel')
                    ->components([
                        TextEntry::make('title')->label('Judul'),
                        TextEntry::make('status')->label('Status'),
                        ImageEntry::make('featured_image_url')->label('Featured Image'),
                        TextEntry::make('meta_title')->label('Meta Title'),
                        TextEntry::make('meta_description')->label('Meta Description'),
                        TextEntry::make('html')->label('Preview')->html(),
                    ]),
            ]);
    }
}

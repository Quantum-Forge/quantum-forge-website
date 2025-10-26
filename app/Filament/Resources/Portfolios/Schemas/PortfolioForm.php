<?php

namespace App\Filament\Resources\Portfolios\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Illuminate\Support\Str;
use Filament\Schemas\Schema;

class PortfolioForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->gap('md')
            ->components([
                // Informasi utama
                Section::make('Informasi Utama')
                    ->columnSpan(['md' => 12])
                    ->components([
                        Grid::make(['md' => 12])
                            ->components([
                                TextInput::make('title')
                                    ->label('Judul')
                                    ->placeholder('Masukkan judul proyek')
                                    ->required()
                                    ->minLength(3)
                                    ->maxLength(150)
                                    ->helperText('Judul singkat dan jelas. Slug terisi otomatis.')
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(function (Set $set, ?string $state) {
                                        $set('slug', Str::slug($state ?? ''));
                                    })
                                    ->columnSpan(['md' => 12]),
                                DatePicker::make('date')
                                    ->label('Tanggal')
                                    ->required()
                                    ->displayFormat('d/m/Y')
                                    ->helperText('Tanggal proyek dimulai / dipublikasikan.')
                                    ->columnSpan(['md' => 6]),
                                TextInput::make('clients')
                                    ->label('Klien')
                                    ->required()
                                    ->maxLength(100)
                                    ->placeholder('Nama klien')
                                    ->columnSpan(['md' => 6]),
                                Select::make('category_id')
                                    ->label('Kategori')
                                    ->relationship('category', 'name')
                                    ->searchable()
                                    ->preload()
                                    ->required()
                                    ->native(false)
                                    ->columnSpan(['md' => 6]),
                                TextInput::make('kota')
                                    ->label('Kota')
                                    ->required()
                                    ->maxLength(100)
                                    ->placeholder('Lokasi/kota')
                                    ->columnSpan(['md' => 6]),
                                Toggle::make('is_active')
                                    ->label('Aktif')
                                    ->required()
                                    ->helperText('Tampilkan proyek di situs.')
                                    ->columnSpan(['md' => 12]),
                            ]),
                    ]),

                // Media & Deskripsi
                Section::make('Media & Deskripsi')
                    ->columnSpan(['md' => 12])
                    ->components([
                        FileUpload::make('images1')
                            ->label('Gambar Utama')
                            ->image()
                            ->acceptedFileTypes(['image/*'])
                            ->maxSize(3072)
                            ->imagePreviewHeight('200')
                            ->disk('public')
                            ->directory('portfolios')
                            ->previewable(true)
                            ->downloadable()
                            ->helperText('Format JPG/PNG/WebP, ukuran maks 3MB.')
                            ->default(null)
                            ->columnSpan(['md' => 12]),
                        Textarea::make('description_proyek')
                            ->label('Deskripsi Proyek')
                            ->required()
                            ->rows(6)
                            ->maxLength(1000)
                            ->placeholder('Gambarkan tujuan, proses, dan hasil.')
                            ->columnSpan(['md' => 12]),
                        TextInput::make('link')
                            ->label('Tautan')
                            ->placeholder('https://contoh.com')
                            ->url()
                            ->helperText('Opsional. Tautan ke halaman proyek.')
                            ->default(null)
                            ->columnSpan(['md' => 12]),
                    ]),

                // Pemasaran Digital
                Section::make('Pemasaran Digital')
                    ->columnSpan(['default' => 1, 'lg' => 12])
                    ->components([
                        Grid::make(12)
                            ->components([
                                TextInput::make('heading')
                                    ->label('Heading')
                                    ->required()
                                    ->maxLength(150)
                                    ->placeholder('Judul pemasaran')
                                    ->columnSpan(['default' => 1, 'lg' => 12]),
                                Textarea::make('description2')
                                    ->label('Deskripsi Pemasaran')
                                    ->required()
                                    ->rows(6)
                                    ->maxLength(1000)
                                    ->placeholder('Detail strategi, kanal, atau performa.')
                                    ->columnSpan(['default' => 1, 'lg' => 12]),
                                FileUpload::make('images2')
                                    ->label('Gambar 2')
                                    ->image()
                                    ->acceptedFileTypes(['image/*'])
                                    ->maxSize(3072)
                                    ->disk('public')
                                    ->directory('portfolios')
                                    ->previewable(true)
                                    ->downloadable()
                                    ->default(null)
                                    ->columnSpan(['default' => 1, 'lg' => 6]),
                                FileUpload::make('images3')
                                    ->label('Gambar 3')
                                    ->image()
                                    ->acceptedFileTypes(['image/*'])
                                    ->maxSize(3072)
                                    ->disk('public')
                                    ->directory('portfolios')
                                    ->previewable(true)
                                    ->downloadable()
                                    ->default(null)
                                    ->columnSpan(['default' => 1, 'lg' => 6]),
                                FileUpload::make('images4')
                                    ->label('Gambar 4')
                                    ->image()
                                    ->acceptedFileTypes(['image/*'])
                                    ->maxSize(3072)
                                    ->disk('public')
                                    ->directory('portfolios')
                                    ->previewable(true)
                                    ->downloadable()
                                    ->default(null)
                                    ->columnSpan(['default' => 1, 'lg' => 12]),
                            ]),
                    ]),

                // Tag & Slug
                Section::make('Tag & Slug')
                    ->columnSpan(['md' => 12])
                    ->components([
                        TagsInput::make('tags')
                            ->label('Tag')
                            ->placeholder('Tambah tag...')
                            ->helperText('Gunakan Enter untuk menambah tag.')
                            ->default(null)
                            ->columnSpan(['md' => 12]),
                        TextInput::make('slug')
                            ->label('Slug')
                            ->required()
                            ->hidden()
                            ->unique(ignoreRecord: true)
                            ->dehydrateStateUsing(fn ($state, $get) => Str::slug($get('title') ?? '')),
                    ]),
            ]);
    }
}

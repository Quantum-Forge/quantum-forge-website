<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Article extends Model
{
    use HasFactory;

    public const STATUS_DRAFT = 'draft';
    public const STATUS_GENERATING = 'generating';
    public const STATUS_READY = 'ready';
    public const STATUS_PUBLISHED = 'published';
    public const STATUS_FAILED = 'failed';

    protected $fillable = [
        'author_user_id',
        'topic',
        'title',
        'slug',
        'tone',
        'keywords',
        'image_prompt',
        'featured_image_url',
        'markdown',
        'html',
        'meta_title',
        'meta_description',
        'status',
        'generated_at',
        'published_at',
        'failure_reason',
    ];

    protected $casts = [
        'keywords' => 'array',
        'generated_at' => 'datetime',
        'published_at' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::creating(function (self $article) {
            if (blank($article->title)) {
                $article->title = $article->topic;
            }

            if (blank($article->slug)) {
                $article->slug = Str::slug($article->title);
            }

            if (blank($article->status)) {
                $article->status = self::STATUS_DRAFT;
            }
        });

        static::updating(function (self $article) {
            if ($article->isDirty('title') && filled($article->title)) {
                $article->slug = Str::slug($article->title);
            }
        });
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_user_id');
    }

    public function generations(): HasMany
    {
        return $this->hasMany(ArticleGeneration::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(ArticleImage::class);
    }
}


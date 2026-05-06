<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ArticleGeneration extends Model
{
    use HasFactory;

    protected $fillable = [
        'article_id',
        'provider',
        'model',
        'input',
        'prompt',
        'raw_response',
        'token_usage',
        'latency_ms',
        'status',
        'error_message',
    ];

    protected $casts = [
        'input' => 'array',
        'token_usage' => 'array',
    ];

    public function article(): BelongsTo
    {
        return $this->belongsTo(Article::class);
    }
}


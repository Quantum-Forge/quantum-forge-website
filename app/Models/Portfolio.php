<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Portfolio extends Model
{
    protected $fillable = [
        'title',
        'date',
        'clients',
        'category',
        'kota',
        'description_proyek',
        'link',
        'images1',
        'heading',
        'description2',
        'images2',
        'images3',
        'images4',
        'is_active',
        'slug',
        'tags',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'date' => 'date',
        'is_active' => 'boolean',
        'tags' => 'array',
        'created_by' => 'integer',
        'updated_by' => 'integer',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($portfolio) {
            if (empty($portfolio->slug)) {
                $portfolio->slug = Str::slug($portfolio->title);
            }
            if (auth()->check()) {
                $portfolio->created_by = auth()->id();
            }
        });

        static::updating(function ($portfolio) {
            if (auth()->check()) {
                $portfolio->updated_by = auth()->id();
            }
        });
    }

    // Relationships
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Removed scopeFeatured and scopeOrdered to match current form fields


    // Accessors
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getImageUrlAttribute($imagePath)
    {
        if (!$imagePath) return null;
        return asset($imagePath);
    }

    public function getImages1UrlAttribute()
    {
        return $this->getImageUrlAttribute($this->images1);
    }

    public function getImages2UrlAttribute()
    {
        return $this->getImageUrlAttribute($this->images2);
    }

    public function getImages3UrlAttribute()
    {
        return $this->getImageUrlAttribute($this->images3);
    }

    public function getImages4UrlAttribute()
    {
        return $this->getImageUrlAttribute($this->images4);
    }
}

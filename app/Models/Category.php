<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'is_active',
    ];

    public function portfolios(): HasMany
    {
        return $this->hasMany(Portfolio::class);
    }

    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function (Category $category) {
            if (empty($category->slug)) {
                $category->slug = \Illuminate\Support\Str::slug($category->name);
            }
        });

        static::deleting(function (Category $category) {
            if ($category->portfolios()->exists()) {
                throw new \RuntimeException('Kategori memiliki portfolio terkait dan tidak dapat dihapus.');
            }
            if ($category->articles()->exists()) {
                throw new \RuntimeException('Kategori memiliki artikel terkait dan tidak dapat dihapus.');
            }
        });
    }
}

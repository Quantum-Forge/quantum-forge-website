<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Article extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'category_id',
        'content',
        'image_url',
        'tags',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'tags' => 'array',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function getContentWithAdsAttribute(): string
    {
        $html = (string) ($this->content ?? '');
        if ($html === '') {
            return '';
        }

        $html = preg_replace('/<(ul|ol)\b[^>]*>/i', '<$1 class="list-style-one">', $html);

        $enabled = (bool) config('services.adsense.enabled');
        $clientId = trim((string) config('services.adsense.client_id'));
        $inArticleSlot = trim((string) config('services.adsense.in_article_slot'));

        if (! $enabled || $clientId === '' || $inArticleSlot === '') {
            return $html;
        }

        if (stripos($html, 'adsbygoogle') !== false) {
            return $html;
        }

        $afterParagraph = (int) config('services.adsense.in_article_after_paragraph', 2);
        $afterParagraph = max(1, $afterParagraph);

        $adHtml = $this->adsenseInArticleHtml($clientId, $inArticleSlot);

        return $this->injectHtmlAfterNthParagraph($html, $adHtml, $afterParagraph);
    }

    private function adsenseInArticleHtml(string $clientId, string $slot): string
    {
        $clientEscaped = e($clientId);
        $slotEscaped = e($slot);

        return '<div class="my-4" style="text-align:center">'
            . '<ins class="adsbygoogle" style="display:block" data-ad-layout="in-article" data-ad-format="fluid" data-ad-client="' . $clientEscaped . '" data-ad-slot="' . $slotEscaped . '"></ins>'
            . '<script>(adsbygoogle=window.adsbygoogle||[]).push({});</script>'
            . '</div>';
    }

    private function injectHtmlAfterNthParagraph(string $html, string $injectionHtml, int $n): string
    {
        $parts = preg_split('/(<\/p>)/i', $html, -1, PREG_SPLIT_DELIM_CAPTURE);
        if (! is_array($parts) || count($parts) < 2) {
            return $html . $injectionHtml;
        }

        $paragraphCount = 0;
        $result = '';

        foreach ($parts as $part) {
            $result .= $part;

            if (preg_match('/<\/p>/i', $part)) {
                $paragraphCount++;
                if ($paragraphCount === $n) {
                    $result .= $injectionHtml;
                }
            }
        }

        if ($paragraphCount < $n) {
            $result .= $injectionHtml;
        }

        return $result;
    }
}

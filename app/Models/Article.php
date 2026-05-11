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
        $html = $this->normalizeBlockquotes($html);

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

    private function normalizeBlockquotes(string $html): string
    {
        if (stripos($html, '<blockquote') === false) {
            return $html;
        }

        $previousUseErrors = libxml_use_internal_errors(true);

        try {
            $doc = new \DOMDocument('1.0', 'UTF-8');
            $wrapperId = '__qf_root__';
            $doc->loadHTML(
                '<?xml encoding="utf-8" ?><div id="' . $wrapperId . '">' . $html . '</div>',
                LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD
            );

            $root = $doc->getElementById($wrapperId);
            if (! $root) {
                return $html;
            }

            $xpath = new \DOMXPath($doc);

            $blockquotes = [];
            foreach ($root->getElementsByTagName('blockquote') as $blockquote) {
                $blockquotes[] = $blockquote;
            }

            foreach ($blockquotes as $blockquote) {
                $existing = $xpath->query(
                    './/*[contains(concat(" ", normalize-space(@class), " "), " blockquote-text ")]',
                    $blockquote
                );

                if ($existing && $existing->length > 0) {
                    continue;
                }

                $div = $doc->createElement('div');
                $div->setAttribute('class', 'blockquote-text');

                $span = $doc->createElement('span');
                $span->setAttribute('class', 'quote icofont-quote-left');
                $div->appendChild($span);

                $elementChildren = [];
                foreach ($blockquote->childNodes as $childNode) {
                    if ($childNode->nodeType === XML_ELEMENT_NODE) {
                        $elementChildren[] = $childNode;
                    } elseif ($childNode->nodeType === XML_TEXT_NODE && trim($childNode->textContent) !== '') {
                        $elementChildren[] = $childNode;
                    }
                }

                $singleP = count($elementChildren) === 1
                    && $elementChildren[0] instanceof \DOMElement
                    && strtolower($elementChildren[0]->nodeName) === 'p';

                if ($singleP) {
                    $p = $elementChildren[0];
                    while ($p->firstChild) {
                        $div->appendChild($p->removeChild($p->firstChild));
                    }
                    $blockquote->removeChild($p);
                } else {
                    while ($blockquote->firstChild) {
                        $div->appendChild($blockquote->removeChild($blockquote->firstChild));
                    }
                }

                $blockquote->appendChild($div);
            }

            $output = '';
            foreach ($root->childNodes as $child) {
                $output .= $doc->saveHTML($child);
            }

            return $output;
        } catch (\Throwable $e) {
            return $html;
        } finally {
            libxml_clear_errors();
            libxml_use_internal_errors($previousUseErrors);
        }
    }
}

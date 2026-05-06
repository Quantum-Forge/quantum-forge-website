<?php

namespace App\Services\Markdown;

use Illuminate\Support\Str;

class MarkdownRenderer
{
    public function toHtml(string $markdown): string
    {
        return (string) Str::markdown($markdown);
    }
}


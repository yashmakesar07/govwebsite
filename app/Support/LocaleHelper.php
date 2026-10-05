<?php

namespace App\Support;

class LocaleHelper
{
    public static function switchUrl(string $targetLocale): string
    {
        $currentUri = request()->path();
        $query = request()->getQueryString();

        $segments = explode('/', ltrim($currentUri, '/'));
        if (!empty($segments[0]) && in_array($segments[0], ['en', 'hi'])) {
            $segments[0] = $targetLocale;
            $newPath = implode('/', $segments);
        } else {
            $newPath = $targetLocale . (empty($currentUri) || $currentUri === '/' ? '' : '/' . $currentUri);
        }

        $url = url($newPath);
        return $query ? "{$url}?{$query}" : $url;
    }
}

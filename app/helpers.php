<?php

use Illuminate\Support\Str;

if (!function_exists('md_to_html')) {
    function md_to_html($markdown)
    {
        return Str::of($markdown)->markdown([
            'html_input' => 'escape',
            'allow_unsafe_links' => false,
            'max_nesting_level' => 10,
        ]);
    }
}

if (!function_exists('mentions_to_links')) {
    function mentions_to_links($markdown)
    {
        return preg_replace('/@([\w\-.]+)/', '<a href="/user/$1" wire:navigate>@$1</a>', $markdown);
    }
}

<?php

namespace App\Concerns;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Casts\Attribute;

trait HasBody
{
    public function bodyExcerpt(): Attribute
    {
        return Attribute::make(function ($value) {
            return Str::limit($this->body, 400);
        });
    }

    public function bodyHtml(): Attribute
    {
        return Attribute::make(function ($value) {
            return Str::of($this->body)->markdown([
                'html_input' => 'escape',
                'allow_unsafe_links' => false,
                'max_nesting_level' => 10,
            ]);
        });
    }
}

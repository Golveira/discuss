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
}

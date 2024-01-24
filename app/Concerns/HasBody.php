<?php

namespace App\Concerns;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Str;

trait HasBody
{
    public function bodyExcerpt(): Attribute
    {
        return Attribute::make(function ($value) {
            return Str::limit($this->body, 400);
        });
    }
}

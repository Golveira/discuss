<?php

namespace App\Concerns;

use Illuminate\Support\Str;

trait HasSlug
{
    public static function bootHasSlug()
    {
        static::creating(function ($model) {
            $model->slug = $model->generateUniqueSlug();
        });
    }

    public function generateUniqueSlug(): string
    {
        $originalSlug = Str::slug($this->title);
        $slug = $originalSlug;
        $suffix = 2;

        while ($this->slugExists($slug)) {
            $slug = "{$originalSlug}-{$suffix}";
            $suffix++;
        }

        return $slug;
    }

    public function slugExists($slug): bool
    {
        return static::where('slug', $slug)->exists();
    }
}

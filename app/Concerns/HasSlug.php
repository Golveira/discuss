<?php

namespace App\Concerns;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

trait HasSlug
{
    public static function bootHasSlug()
    {
        static::creating(function (Model $model) {
            $model->slug = $model->generateUniqueSlug();
        });

        static::updating(function (Model $model) {
            $model->slug = $model->generateUniqueSlug();
        });
    }

    public function generateUniqueSlug(): string
    {
        $originalSlug = Str::slug($this->title);
        $slug = $originalSlug;
        $suffix = 2;

        while ($this->slugExists($slug, $this->id)) {
            $slug = "{$originalSlug}-{$suffix}";
            $suffix++;
        }

        return $slug;
    }

    public function slugExists(string $slug, ?int $ignoreId = null): bool
    {
        $query = $this->where('slug', $slug);

        if ($ignoreId) {
            $query->where('id', '!=', $ignoreId);
        }

        return $query->exists();
    }
}

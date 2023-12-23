<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Channel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description'
    ];

    public function threads(): HasMany
    {
        return $this->hasMany(Thread::class);
    }

    public function path(): Attribute
    {
        return Attribute::make(function () {
            return "/discussions/channels/{$this->slug}";
        });
    }
}

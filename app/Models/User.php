<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'username',
        'email',
        'avatar_path',
        'is_admin',
        'banned_at',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function threads(): HasMany
    {
        return $this->hasMany(Thread::class);
    }

    public function replies(): HasMany
    {
        return $this->hasMany(Reply::class);
    }

    public function likes(): HasMany
    {
        return $this->hasMany(Like::class);
    }

    public function subscriptions(): HasMany
    {
        return $this->hasMany(ThreadSubscription::class);
    }

    public function joinedDate(): Attribute
    {
        return Attribute::make(function () {
            return $this->created_at->format('M Y');
        });
    }

    public function avatarFullPath(): string
    {
        return $this->avatar_path
            ? asset("storage/{$this->avatar_path}")
            : asset('assets/images/avatar.png');
    }

    public function isAdmin(): bool
    {
        return $this->is_admin;
    }

    public function isBanned(): bool
    {
        return ! is_null($this->banned_at);
    }

    public function ban(): void
    {
        $this->update(['banned_at' => now()]);
    }

    public function unban(): void
    {
        $this->update(['banned_at' => null]);
    }

    public function scopeOrderByMostSolutions(Builder $query)
    {
        return $query->withCount([
            'replies as solutions_count' => function ($query) {
                $query->whereHas('thread', function ($query) {
                    $query->whereColumn('best_reply_id', 'replies.id');
                });
            },
        ])->orderByDesc('solutions_count');
    }
}

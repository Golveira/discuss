<?php

namespace App\Models;

use App\Models\Like;
use App\Models\Reply;
use App\Models\Thread;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
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

    public function avatarPath(): Attribute
    {
        return Attribute::make(function () {
            return 'https://i.pravatar.cc/200?u=' . $this->email;
        });
    }

    public function userNameInitials(): Attribute
    {
        return Attribute::make(function () {
            return strtoupper(substr($this->username, 0, 2));
        });
    }

    public function joinedDate(): Attribute
    {
        return Attribute::make(function () {
            return $this->created_at->format('M Y');
        });
    }

    public function isAdmin(): bool
    {
        return $this->is_admin;
    }

    public function isBanned(): bool
    {
        return !is_null($this->banned_at);
    }

    public function scopeByMostSolutions($query)
    {
        return $query->withCount([
            "replies as solutions_count" => function ($query) {
                $query->whereHas("thread", function ($query) {
                    $query->whereColumn("best_reply_id", "replies.id");
                });
            }
        ])->orderByDesc("solutions_count");
    }
}

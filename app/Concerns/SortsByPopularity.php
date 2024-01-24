<?php

namespace App\Concerns;

trait SortsByPopularity
{
    public function scopeRecent($query)
    {
        $query->orderBy('updated_at', 'desc');
    }

    public function scopePopular($query)
    {
        $query->orderBy('replies_count', 'desc')
            ->orderBy('likes_count', 'desc')
            ->recent();
    }

    public function scopePopularToday($query)
    {
        $query->popular()->whereBetween('created_at', [now()->subDay(), now()]);
    }

    public function scopePopularThisWeek($query)
    {
        $query->popular()->whereBetween('created_at', [now()->subWeek(), now()]);
    }

    public function scopePopularThisMonth($query)
    {
        $query->popular()->whereBetween('created_at', [now()->subMonth(), now()]);
    }

    public function scopePopularThisYear($query)
    {
        $query->popular()->whereBetween('created_at', [now()->subYear(), now()]);
    }

    public function scopePopularAllTime($query)
    {
        $query->popular();
    }
}

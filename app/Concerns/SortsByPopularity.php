<?php

namespace App\Concerns;

trait SortsByPopularity
{
    public function scopePopular($query)
    {
        $query->orderByRaw('(likes_count + replies_count) DESC')
            ->orderBy('replies_count', 'desc')
            ->orderBy('likes_count', 'desc')
            ->recent();
    }

    function scopePopularThisWeek($query)
    {
        $query->popular()->whereBetween('created_at', [now()->subWeek(), now()]);
    }
}

<?php

use App\Models\User;
use App\Models\Reply;
use App\Models\Thread;

test('returns parent replies', function () {
    $parentReply = Reply::factory()->create();
    $childReply = Reply::factory()->create(['parent_id' => $parentReply->id]);

    $replies = Reply::parentReply()->get();

    expect($replies->count())->toEqual(1);
    expect($replies->first()->id)->toEqual($parentReply->id);
});

test('returns child replies', function () {
    $parentReply = Reply::factory()->create();
    $childReply = Reply::factory()->create(['parent_id' => $parentReply->id]);

    $replies = Reply::childReply()->get();

    expect($replies->count())->toEqual(1);
    expect($replies->first()->id)->toEqual($childReply->id);
});

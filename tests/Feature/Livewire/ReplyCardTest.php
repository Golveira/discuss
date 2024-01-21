<?php

use App\Livewire\ReplyCard;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(ReplyCard::class)
        ->assertStatus(200);
});

<?php

use App\Livewire\Notifications\NotificationIndex;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(NotificationIndex::class)
        ->assertStatus(200);
});

<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use App\Models\Thread;
use Livewire\Attributes\Validate;

class ThreadForm extends Form
{
    #[Validate('required|min:1|max:100')]
    public string $title = '';

    #[Validate('required|min:1|max:10000',)]
    public string $body = '';

    #[Validate('required|exists:categories,id', as: 'category')]
    public string $category_id = '';

    public function setProperties(Thread $thread)
    {
        $this->title = $thread->title;
        $this->body = $thread->body;
        $this->category_id = $thread->category_id;
    }
}

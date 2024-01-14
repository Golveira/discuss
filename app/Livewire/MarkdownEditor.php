<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Modelable;

class MarkdownEditor extends Component
{
    public string $mode = 'write';

    public string $label;

    public string $placeholder;

    public string $title;

    public string $height = 'h-48';

    public bool $hasBorder = true;

    public array $mentionableItems = [];

    #[Modelable]
    public string $content;

    #[Computed]
    public function contentPreview(): string
    {
        return mentions_to_links(md_to_html($this->content));
    }

    public function getMentionableItems(string $query)
    {
        $users = User::where("username", "like", "%$query%")->limit(5)->get();

        $this->mentionableItems = $users->map(function ($user) {
            return ['key' => $user->username, 'value' => $user->username];
        })->toArray();

        $this->dispatch('mentionable-items-updated');
    }

    public function render()
    {
        return view('livewire.markdown-editor');
    }
}

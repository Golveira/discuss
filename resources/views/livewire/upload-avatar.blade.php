<div>
    <x-forms.label for="avatar" value="Profile picture" />

    <label for="avatar">
        <x-avatar :image="auth()
            ->user()
            ->avatarFullPath()" width="lg" />
    </label>

    <input class="hidden" id="avatar" name="avatar" type="file" wire:model="avatar">

    <x-forms.input-error name="avatar" />
</div>

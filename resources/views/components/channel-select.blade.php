<x-forms.select class="w-full" {{ $attributes }}>
    <option value selected disabled>
        {{ __('Select Channel') }}
    </option>

    @foreach ($channels as $channel)
        <option value="{{ $channel->id }}">
            {{ $channel->name }}
        </option>
    @endforeach
</x-forms.select>

<x-forms.select {{ $attributes->merge(['class' => 'w-full']) }}>
    <option value="recent">
        {{ __('Recent') }}
    </option>

    <option value="popular_week">
        {{ __('Popular This Week') }}
    </option>

    <option value="popular_all">
        {{ __('Popular All Time') }}
    </option>
</x-forms.select>

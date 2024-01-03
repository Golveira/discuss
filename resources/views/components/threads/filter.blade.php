<x-forms.select {{ $attributes->merge(['class' => 'w-full']) }}>
    <option value="all">
        {{ __('All') }}
    </option>

    <option value="resolved">
        {{ __('Resolved') }}
    </option>

    <option value="unresolved">
        {{ __('Unresolved') }}
    </option>
</x-forms.select>

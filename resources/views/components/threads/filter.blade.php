<x-forms.select {{ $attributes->merge(['class' => 'w-full']) }}>
    <option value="open">
        {{ __('Open') }}
    </option>

    <option value="closed">
        {{ __('Closed') }}
    </option>

    <option value="answered">
        {{ __('Answered') }}
    </option>

    <option value="unanswered">
        {{ __('Unanswered') }}
    </option>

    <option value="all">
        {{ __('All') }}
    </option>
</x-forms.select>

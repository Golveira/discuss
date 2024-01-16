<x-forms.select {{ $attributes->merge(['class' => 'w-full']) }}>
    <option value="open">
        {{ __('Open') }}
    </option>

    <option value="closed">
        {{ __('Closed') }}
    </option>

    <option value="resolved">
        {{ __('Answered') }}
    </option>

    <option value="unresolved">
        {{ __('Unanswered') }}
    </option>

    <option value="all">
        {{ __('All') }}
    </option>
</x-forms.select>

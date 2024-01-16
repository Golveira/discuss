<x-forms.select {{ $attributes->merge(['class' => 'w-full']) }}>
    <option value="latest_activity">
        {{ __('Latest activity') }}
    </option>

    <option value="date_created">
        {{ __('Date created') }}
    </option>

    <option value="top_day">
        {{ __('Top: Past day') }}
    </option>

    <option value="top_week">
        {{ __('Top: Past week') }}
    </option>

    <option value="top_month">
        {{ __('Top: Past month') }}
    </option>

    <option value="top_year">
        {{ __('Top: Past year') }}
    </option>

    <option value="top_all">
        {{ __('Top: All') }}
    </option>
</x-forms.select>

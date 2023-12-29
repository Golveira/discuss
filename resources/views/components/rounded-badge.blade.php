@props(['value'])

<span class="ms-2 inline-flex items-center justify-center rounded-full bg-blue-200 text-xs font-semibold text-blue-800">
    {{ $value ?? $slot }}
</span>

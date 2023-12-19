@php
    $classes = $errors->has($attributes->get('name')) ? 'block w-full cursor-pointer rounded-lg border border-red-500 bg-red-50 text-sm text-red-900 focus:outline-none dark:text-red-500 dark:placeholder-red-500 dark:border-red-500 dark:bg-gray-700' : 'block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400';
@endphp

<input type="file" {{ $attributes->merge(['class' => $classes]) }}>

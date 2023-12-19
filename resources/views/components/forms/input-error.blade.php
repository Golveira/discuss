@props(['name'])

@error($name)
    <div class="mt-2 text-sm text-red-600 dark:text-red-400">
        {{ $message }}
    </div>
@enderror

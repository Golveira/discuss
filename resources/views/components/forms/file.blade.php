<label class="sr-only" for="file-input">Choose file</label>

<input type="file"
    {{ $attributes->merge(['class' => 'block w-full rounded-lg border border-gray-300 text-sm file:me-4 file:border-0 file:bg-gray-100 file:px-4 file:py-3 focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:file:bg-gray-600 dark:file:text-white dark:focus:border-blue-500 dark:focus:ring-blue-500']) }}>

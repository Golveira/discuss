<div class="mb-4 w-full rounded-lg bg-red-700 p-4 text-sm text-white" role="alert">
    <h3 class="mb-3 font-medium">
        {{ __('The following errors were found:') }}
    </h3>

    <ul class="max-w-md list-inside list-disc space-y-1 text-white">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>

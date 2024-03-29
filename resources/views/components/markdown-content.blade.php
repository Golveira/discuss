@props(['content'])

<div
    {{ $attributes->merge(['class' => 'max-w-full prose dark:prose-invert prose-a:no-underline prose-a:text-blue-500 prose-img:rounded-xl']) }}>
    {!! md_to_html($content) !!}
</div>

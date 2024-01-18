<div
    {{ $attributes->merge(['class' => 'max-w-full prose dark:prose-invert prose-a:no-underline prose-a:text-blue-500 prose-img:rounded-xl']) }}>
    {!! html_entity_decode(mentions_to_links(md_to_html($slot))) !!}
</div>

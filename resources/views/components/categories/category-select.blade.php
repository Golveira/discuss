<x-forms.select {{ $attributes }} label="Choose a category">
    <option value="" disabled selected>
        Choose a category
    </option>

    @foreach ($categories as $category)
        <option value="{{ $category->id }}">
            {{ $category->name }}
        </option>
    @endforeach
</x-forms.select>

@foreach ($categories as $category)
    <option
        value="{{ $category->id }}"
        @if($currentCategory->contains($category->id))
        selected='selected'
        @endif
    >
    {!! $prefix !!} {{ $category->title }}
    </option>
    @if (count($category->children))
        @include('components.category._options', ['categories' => $category->children, 'prefix' => $prefix . ' &mdash; ', 'currentCategory' => $currentCategory])
    @endif
@endforeach

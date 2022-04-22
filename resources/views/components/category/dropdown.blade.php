@props(['name' => 'category'])
<x-select name="{{ $name }}" {{$attributes}} >
    @if( !isset($attributes['multiple']))
    <option value="">{{ __('Category') }}</option>
    @endif
    @include('components.category._options', ['categories' => $categories, 'prefix' => '', 'currentCategory' => $currentCategory])
</x-select>

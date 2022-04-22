@props(['name' => 'product'])
<x-select name="{{ $name }}" {{$attributes}} >
    @if( !isset($attributes['multiple']))
        <option value="">{{ __('Product') }}</option>
    @endif

    @foreach ($products as $product)
        <option
            value="{{ $product->id }}"
            @if($currentProduct->contains($product->id))
            selected='selected'
            @endif
        >
            {{ $product->name }}
        </option>
    @endforeach

</x-select>

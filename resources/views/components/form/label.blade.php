@props(['name'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-gray-700']) }}
       for="{{ $name }}">
    {{ ucwords($name) }}
</label>

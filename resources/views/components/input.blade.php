@props(['name', 'type' => 'text'])

<input
    {{ $attributes([
         'value' => old($name),
         'class' => 'rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50'
         ]) }}
    type="{{ $type }}"
    name="{{ $name }}"
    id="{{ $name }}"
>

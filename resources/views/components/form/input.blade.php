@props(['name'])
<div>
    <x-form.label name="{{ $name }}" />

    <input
           {{ $attributes([
                'value' => old($name),
                'class' => 'rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50'
                ]) }}
           type="text"
           name="{{ $name }}"
           id="{{ $name }}"
    >
    <x-form.error name="{{ $name }}"/>
</div>

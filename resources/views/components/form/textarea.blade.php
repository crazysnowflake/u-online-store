@props(['name', 'fieldclass' => ''])

<div class="{{  $fieldclass }}">
    <x-form.label name="{{ $name }}"/>

    <textarea
        name="{{ $name }}"
        id="{{ $name }}"
        {{ $attributes(['class' => 'rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50']) }}
    >{{ $slot }}</textarea>
    <x-form.error name="{{ $name }}"/>
</div>
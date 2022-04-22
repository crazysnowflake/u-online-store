@props(['name', 'empty' => '', 'options' => [], 'selected' => ''])
@php
$id = $name;
$name .= isset($attributes['multiple'] ) ? '[]' : '';
@endphp
<select name="{{ $name }}" id="{{ $name }}"  {{ $attributes([
                'class' => 'rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50'
                ]) }}>
    @if(!empty($options))
        <option value="">{{ $empty }}</option>
        @foreach ($options as $option_value => $option_name)
            <option
                value="{{ $option_value }}"
                @if($selected === $option_value)
                selected='selected'
                @endif            >
                {{ $option_name }}
            </option>
        @endforeach
    @else
    {{ $slot }}
    @endif
</select>

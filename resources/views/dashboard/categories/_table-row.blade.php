@foreach($categories as $category)
    <x-table-row>
        <x-table-column>{!! $prefix !!}{{$category->title}}</x-table-column>
        <x-table-column>
            <div class="flex justify-between">
                <a href="{{ route('categories.edit', ['category' => $category->id]) }}"
                   class="text-indigo-700 px-2">{{ __('Edit') }}</a>
                <x-confirm-delete :action="route('categories.destroy', ['category' => $category->id])" />
            </div>
        </x-table-column>
    </x-table-row>
    @if( count($category->children) )
        @include('dashboard.categories._table-row', ['categories' => $category->children, 'prefix' => $prefix . ' &mdash; '])
    @endif
@endforeach

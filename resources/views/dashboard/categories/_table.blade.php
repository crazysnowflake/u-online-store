<form method="GET" action="{{ route('categories.index') }}" class="w-full flex justify-end px-2 mt-2">
    <x-input name="search" type="text" placeholder="{{ __('Search') }}" class="flex-1 mr-3"
             value="{{ request('search') }}"/>
    <x-button-light>Search</x-button-light>
    @if(request('search') )
        <a href="/dashboard/categories" class="inline-flex items-center px-4 py-2 text-sm">{{ __('Reset') }}</a>
    @endif
</form>
@if ($categories->count() )

    <div class="overflow-x-auto mt-6">
        <x-table>
            <x-slot name="header">
                <x-table-column class="w-full">Title</x-table-column>
                <x-table-column>Actions</x-table-column>
            </x-slot>
            @include('dashboard.categories._table-row', ['categories' => $categories, 'prefix' => ''])
        </x-table>

    </div>

    <div class="mt-4">
        {{ $categories->links() }}
    </div>
@else
    <p class="text-center py-10">{{ __('No categories found.') }}</p>
@endif

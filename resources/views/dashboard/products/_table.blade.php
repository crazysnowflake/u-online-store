<form method="GET" action="{{ route('products.index') }}" class="w-full flex justify-end px-2 mt-2">
    <x-input name="search" type="text" placeholder="{{ __('Search') }}" class="flex-1 mr-3"
             value="{{ request('search') }}"/>
    <x-category-dropdown class="mr-3"/>
    <x-button-light>Search</x-button-light>
    @if(request('search') || request('category'))
        <a href="/dashboard/products" class="inline-flex items-center px-4 py-2 text-sm">{{ __('Reset') }}</a>
    @endif
</form>
@if ($products->count() )

    <div class="overflow-x-auto mt-6">
        <x-table>
            <x-slot name="header">
                <x-table-column>Name</x-table-column>
                <x-table-column>SKU</x-table-column>
                <x-table-column>Price</x-table-column>
                <x-table-column>Category</x-table-column>
                <x-table-column>Actions</x-table-column>
            </x-slot>
            @foreach($products as $product)
                <x-table-row>
                    <x-table-column>{{$product->name}}</x-table-column>
                    <x-table-column>{{$product->sku}}</x-table-column>
                    <x-table-column>{{$product->price}}</x-table-column>
                    <x-table-column>
                        @foreach($product->categories as $category)
                            <x-badge>{{ $category->title }}</x-badge>
                        @endforeach
                    </x-table-column>
                    <x-table-column>
                        <div class="flex justify-between">
                            <a href="{{ route('products.edit', ['product' => $product->id]) }}"
                               class="text-indigo-700 px-2">{{ __('Edit') }}</a>
                            <x-confirm-delete :action="route('products.destroy', ['product' => $product->id])" />
                        </div>
                    </x-table-column>
                </x-table-row>
            @endforeach
        </x-table>

    </div>

    <div class="mt-4">
        {{ $products->links() }}
    </div>
@else
    <p class="text-center py-10">{{ __('No products found.') }}</p>
@endif

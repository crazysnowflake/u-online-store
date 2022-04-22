<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create New Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('products.store') }}">
                        @csrf
                        <div class="grid grid-cols-2 gap-4">
                            <x-form.input name="name" class="block mt-1 w-full" autofocus/>
                            <x-form.input name="sku" class="block mt-1 w-full" label="{{ __('SKU') }}"/>
                            <x-form.input name="slug" class="block mt-1 w-full"/>
                            <x-form.input name="price" class="block mt-1 w-full"
                                          type="number" min="0" max="999"
                                          step="0.1"/>
                            <x-form.textarea name="description" class="block mt-1 w-full">{{ old('description') }}</x-form.textarea>
                            <div>
                                <x-form.label name="category" />

                                <x-category-dropdown class="block mt-1 w-full" multiple />

                                <x-form.error name="category"/>
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-button class="ml-4">
                                {{ __('Create') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>

<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create New Category') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('categories.store') }}">
                        @csrf
                        <x-form.input name="title" class="block mt-1 w-full" autofocus/>
                        <div class="grid grid-cols-2 gap-4 mt-4">
                            <x-form.input name="slug" class="block mt-1 w-full"/>
                            <div>
                                <x-form.label name="parent_id" />

                                <x-category-dropdown name="parent_id" class="block mt-1 w-full" />

                                <x-form.error name="parent_id"/>
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

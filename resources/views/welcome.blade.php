<x-app-layout>
    @if (Route::has('login'))
        <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
            @auth
                <a href="{{ url('/dashboard') }}"
                   class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                @endif
            @endauth
        </div>
    @endif

    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        <div class="flex justify-center pt-8 mt-6  sm:pt-0">
            <x-application-logo class="h-16 w-auto text-white fill-current sm:h-20"/>
        </div>

        <div class="mt-8">
            <form method="GET" action="/" class="grid grid-cols-1 md:grid-cols-2 gap-4 ">
                <div>
                    <x-form.label name="product" class="text-white uppercase mb-4"/>
                    <x-product-dropdown class="w-full" multiple/>
                </div>
                <div>
                    <x-form.label name="category" class="text-white uppercase mb-4"/>
                    <div class="flex justify-end">
                        <x-category-dropdown class="mr-3 w-full" multiple/>
                        <x-button-light>Run</x-button-light>
                    </div>
                </div>
            </form>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">

                <x-card class="p-6 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
                    <div class="text-lg leading-7 font-semibold  text-gray-900 dark:text-white">
                        For a given list of products, get the names of all categories in which products are presented
                    </div>

                    <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                        <x-list :items="$one"/>
                    </div>
                </x-card>

                <x-card class="p-6 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
                    <div class="text-lg leading-7 font-semibold  text-gray-900 dark:text-white">
                        For a given category, get a list of offers for all products from this category and its child
                        categories
                    </div>

                    <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                        <x-list :items="$two"/>
                    </div>
                </x-card>
                <x-card class="p-6 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
                    <div class="text-lg leading-7 font-semibold  text-gray-900 dark:text-white">
                        For a given product, get the names of all products from the category in which the product is presented
                    </div>

                    <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                        <x-list :items="$three"/>
                    </div>
                </x-card>

                <x-card class="p-6 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
                    <div class="text-lg leading-7 font-semibold  text-gray-900 dark:text-white">
                        For a given category, get its full path in the tree (breadcrumb)
                    </div>

                    <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                        <x-breadcrumbs :item="$four"/>
                    </div>
                </x-card>

            </div>
        </div>

        <div class="flex justify-center mt-4 sm:items-center sm:justify-between">


            <div class="ml-4 text-center text-sm text-gray-500 sm:text-right sm:ml-0">
                Olena Zhyvohliad
            </div>
        </div>
    </div>
</x-app-layout>

@props(['item'])

@if($item)
<nav class="flex" aria-label="Breadcrumb">
    <ol class="inline-flex items-center space-x-1 md:space-x-3">
        @include('components._breadcrumb-item', ['item' => $item])
    </ol>
</nav>
@endif

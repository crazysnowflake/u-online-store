@props(['items'])
<ul class="list-disc list-inside">
    @foreach( $items as $item_key => $item_name )
        <li>{{ $item_name }} </li>
    @endforeach
</ul>

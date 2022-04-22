@props(['action'])
<form action="{{ $action }}" method="POST" >
    @csrf
    @method('DELETE')

    <button type="submit" class="text-red-600 px-2" onclick="return confirm('Sure Want Delete?')">Delete</button>
</form>

@extends('layouts.app')
@section('content')
<div>
    @can('create', 'App\Models\Tag')
    <form action="{{ route('tags.store') }}" method="POST" class="flex flex-wrap">
        @csrf
        <x-input-text name="title" value="{{ old('title') }}">Title</x-input-text>
        <x-input-color name="color" value="{{ old('color') }}">Color</x-input-color>
        <div class="w-full flex justify-center">
            <button type="submit" class="px-4 py-2 bg-green-200">Post!!</button>
        </div>
    </form>
    @endcan
</div>
<script>
    const color_input = document.getElementById('color');
    const randomColor = Math.floor(Math.random()*16777215).toString(16);
    color_input.value = "#" + randomColor;
</script>
@endsection

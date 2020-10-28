@extends('layouts.app')
@section('content')
<div>
    @can('update', $tag)
    <form action="{{ route('tags.update', $tag) }}" method="POST" class="flex flex-wrap">
        @csrf
        @method('put')
        <x-input-text name="title" value="{{ old('title', $tag->title) }}">Title</x-input-text>
        <x-input-color name="color" value="{{ old('color', $tag->color) }}">Color</x-input-color>
        <div class="w-full flex justify-center">
            <button type="submit" class="px-4 py-2 bg-green-200">Post!!</button>
            <button type="submit" class="px-4 py-2 bg-red-200"
                onclick="event.preventDefault(); document.getElementById('delete-tag-form').submit()">Delete!!</button>
        </div>
    </form>
    <form action="{{ route('tags.destroy', $tag) }}" method="POST" id="delete-tag-form">
        @csrf
        @method('delete')
    </form>
    @else
    You are not allowed to edit or delete tags.
    @endcan
</div>
@endsection

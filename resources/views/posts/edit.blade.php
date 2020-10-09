@extends('layouts.app')
@section('content')
<div>
    <form action="{{ route('posts.update', $post->slug) }}" method="POST" class="flex flex-wrap">
        @csrf
        @method('put')
        <label for="title" class="w-full sm:w-3/12">Title</label>
        <input type="text" name="title" id="title"
            class="border-2 border-gray-300 focus:border-blue-200 w-full sm:w-9/12" value="{{ $post->title }}" />
        <label for="description" class="w-full sm:w-3/12">Content</label>
        <textarea name="description" id="description" cols="30" rows="10"
            class="border-2 border-gray-300 focus:border-blue-200 w-full sm:w-9/12">{{ $post->description }}</textarea>
        <label for="published" class="w-full sm:w-3/12">Publish</label>
        <input type="checkbox" name="published" id="published" checked="{{ $post->published }}" />
        <div class="w-full flex justify-center">
            <button type="submit" class="px-4 py-2 bg-green-200">Update!!</button>
        </div>
    </form>

    <form action="{{ route('posts.destroy', $post->slug) }}" method="POST" class="flex">
        @csrf
        @method('delete')
        <div class="w-full flex justify-center">
            <button type="submit" class="px-4 py-2 bg-red-200">Delete!!</button>
        </div>
    </form>
</div>
@endsection

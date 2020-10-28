@extends('layouts.app')
@section('content')
<div>
    @can('update', $post)
    <form action="{{ route('posts.update', $post->slug) }}" method="POST" class="flex flex-wrap">
        @csrf
        @method('put')
        <x-input-text name="title" value="{{ old('title', $post->title) }}">Title</x-input-text>
        <x-input-text-area name="description">
            <x-slot name="value">
                {{ old('description', $post->description) }}
            </x-slot>
            Description
        </x-input-text-area>
        <x-input-checkbox name="published" published="{{ $post->published }}">Publish {{ $post->published }}
        </x-input-checkbox>
        <div class="w-full flex flex-row flex-wrap items-center my-1">
            <label for="tags" class="w-full sm:w-3/12">Tags</label>
            <select name="tags[]" id="tags" multiple
                class="w-full sm:w-9/12 p-2 border-2 rounded border-gray-400 focus:border-blue-300">
                @foreach ($tags as $tag)
                <option value="{{ $tag->id }}" {{ in_array($tag->id, $tag_ids->toArray()) ? "selected" : "" }}>
                    {{ $tag->title }}

                </option>
                @endforeach
            </select>
        </div>
        <div class="w-full flex justify-around">
            <button type="submit" class="px-4 py-2 bg-green-200">Update!!</button>
            <button type="submit" class="px-4 py-2 bg-red-200"
                onclick="event.preventDefault(); document.getElementById('delete-comment-form').submit()">Delete!!</button>
        </div>
    </form>

    <form action="{{ route('posts.destroy', $post->slug) }}" method="POST" id="delete-comment-form">
        @csrf
        @method('delete')

    </form>
    @else
    You are not authorized to update or delete posts by {{ $post->user->name }}
    @endcan
</div>
@include('posts.tinymce')
@endsection

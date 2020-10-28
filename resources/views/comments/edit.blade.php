@extends('layouts.app')
@section('content')
<div>
    @can('update', $comment)
    <form action="{{ route('comments.update', ["post" => $post->slug, "comment" => $comment->id]) }}" method="POST"
        class="flex flex-wrap">
        @csrf
        @method('put')
        <x-input-text name="title" value="{{ old('title', $comment->title) }}">Title</x-input-text>
        <x-input-text-area name="description">
            <x-slot name="value">
                {{ old('description', $comment->description) }}
            </x-slot>
            Description
        </x-input-text-area>
        <div class="w-full flex justify-around">
            <button type="submit" class="px-4 py-2 bg-green-200">Update!!</button>
            <button type="submit" class="px-4 py-2 bg-red-200"
                onclick="event.preventDefault(); document.getElementById('delete-comment-form').submit()">Delete!!</button>
        </div>
    </form>
    <form class="w-1/2" id="delete-comment-form"
        action="{{ route('comments.destroy', ['post' => $post->slug, 'comment' => $comment->id]) }}" method="POST">
        @csrf
        @method('delete')
    </form>

    @else
    You are not authorized to update or delete comments by {{ $comment->user->name }}
    @endcan
</div>
@endsection

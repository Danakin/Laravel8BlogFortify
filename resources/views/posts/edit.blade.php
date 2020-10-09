@extends('layouts.app')
@section('content')
<div>
    <form action="{{ route('posts.update', $post->slug) }}" method="POST" class="flex flex-wrap">
        @csrf
        @method('put')
        <x-input-text name="title" value="{{ $post->title }}">Title</x-input-text>
        <x-input-text-area name="description">
            <x-slot name="value">
                {{ $post->description }}
            </x-slot>
            Description
        </x-input-text-area>
        <x-input-checkbox name="published" published="{{ $post->published }}">Publish {{ $post->published }}
        </x-input-checkbox>
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

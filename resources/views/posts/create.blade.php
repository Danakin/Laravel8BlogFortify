@extends('layouts.app')
@section('content')
<div>
    @can('create', 'App\Models\Post')
    <form action="{{ route('posts.store') }}" method="POST" class="flex flex-wrap">
        @csrf
        <x-input-text name="title" value="{{ old('title') }}">Title</x-input-text>
        <x-input-text-area name="description">
            <x-slot name="value">
                {{ old('description') }}
            </x-slot>
            Description
        </x-input-text-area>
        <x-input-checkbox name="published">Publish</x-input-checkbox>
        <div class="w-full flex flex-row flex-wrap items-center my-1">
            <label for="tags" class="w-full sm:w-3/12">Tags</label>
            <select name="tags[]" id="tags" multiple
                class="w-full sm:w-9/12 p-2 border-2 rounded border-gray-400 focus:border-blue-300">
                @foreach ($tags as $tag)
                <option value="{{ $tag->id }}">
                    {{ $tag->title }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="w-full flex justify-center">
            <button type="submit" class="px-4 py-2 bg-green-200">Post!!</button>
        </div>
    </form>
    @endcan
</div>

@include('posts.tinymce')
@endsection

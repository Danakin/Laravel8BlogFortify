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
        <label for="published" class="w-full sm:w-3/12">Publish</label>
        <input type="checkbox" name="published" id="published" />
        <div class="w-full flex justify-center">
            <button type="submit" class="px-4 py-2 bg-green-200">Post!!</button>
        </div>
    </form>
    @endcan
</div>

@include('posts.tinymce')
@endsection

@extends('layouts.app')
@section('content')
<div>
    <form action="{{ route('comments.store', ['post' => $post]) }}" method="POST" class="flex flex-wrap">
        @csrf
        <x-input-text name="title" value="{{ old('title') }}">Title</x-input-text>
        <x-input-text-area name="description">
            <x-slot name="value">
                {{ old('description') }}
            </x-slot>
            Description
        </x-input-text-area>
        <div class="w-full flex justify-center">
            <button type="submit" class="px-4 py-2 bg-green-200">Post!!</button>
        </div>
    </form>
</div>

@endsection

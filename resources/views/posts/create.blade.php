@extends('layouts.app')
@section('content')
<div>
    <form action="{{ route('posts.store') }}" method="POST" class="flex flex-wrap">
        @csrf
        <label for="title" class="w-full sm:w-3/12">Title</label>
        <input type="text" name="title" id="title"
            class="border-2 border-gray-300 focus:border-blue-200 w-full sm:w-9/12" />
        <label for="description" class="w-full sm:w-3/12">Content</label>
        <textarea name="description" id="description" cols="30" rows="10"
            class="border-2 border-gray-300 focus:border-blue-200 w-full sm:w-9/12"></textarea>
        <label for="published" class="w-full sm:w-3/12">Publish</label>
        <input type="checkbox" name="published" id="published" />
        <div class="w-full flex justify-center">
            <button type="submit" class="px-4 py-2 bg-green-200">Post!!</button>
        </div>
    </form>
</div>
@endsection

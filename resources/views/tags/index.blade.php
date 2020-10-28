@extends('layouts.app')

@section('content')
<section class="flex flex-col">
    <a href="{{ route('tags.create') }}" class="px-4 py-2 bg-blue-200">New Tag</a>
    @foreach ($tags as $tag)
    <article class="mt-4">
        <a href="{{ route("tags.edit", $tag->id) }}" class="font-bold"
            style="color: {{ $tag->color }}">{{ $tag->title }}</a>
    </article>
    @endforeach
</section>
@endsection

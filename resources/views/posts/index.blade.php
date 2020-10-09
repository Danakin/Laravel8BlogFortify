@extends('layouts.app')

@section('content')
<section class="flex flex-col">
    @foreach ($posts as $post)
    <article class="mt-4">
        <a href="{{ route("posts.show", $post->slug) }}" class="font-bold">{{ $post->title }}</a>
        <p class="text-right">by {{ $post->user->name }}</p>
        <p>{{ $post->short_description }}</p>
    </article>
    @endforeach
</section>
@endsection

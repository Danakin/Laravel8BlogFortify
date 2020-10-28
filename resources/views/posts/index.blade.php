@extends('layouts.app')

@section('content')
<section class="flex flex-col">
    @foreach ($posts as $post)
    <article class="mt-4">
        <a href="{{ route("posts.show", $post->slug) }}" class="font-bold">{{ $post->title }}</a>
        <p class="text-right">by {{ $post->user->name }}</p>
        <p>{{ $post->short_description }}</p>
        @if (count($post->tags) > 0)
        <p class="text-right">
            @foreach ($post->tags as $tag)
            <a href="{{ route('posts.tag', $tag->title) }}" class="ml-2"
                style="color: {{ $tag->color }}">#{{ $tag->title }}</a>
            @endforeach
        </p>
        @endif
    </article>
    @endforeach
</section>
@endsection

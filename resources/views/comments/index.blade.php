@extends('layouts.app')

@section('content')
<section class="flex flex-col">
    @foreach ($comments as $comment)
    <article class="mt-4">
        <a href="{{ route('comments.show', ['post' => $post->slug, 'comment' => $comment->id]) }}"
            class="font-bold">{{ $comment->title }}</a>
        <p class="text-right">by {{ $comment->user->name }}</p>
        <p>{{ $comment->description }}</p>
    </article>
    @endforeach
</section>
@endsection

@extends('layouts.app')

@section('content')
<section class="flex flex-col">
    <article class="mt-4">
        <h3 class="font-bold">{{ $comment->title }}</h3>
        <p class="text-right">by {{ $comment->user->name }}</p>
        <p>{!! $comment->description !!}</p>
    </article>
    @can('update', $comment)
    <div class="mt-4 text-right">
        <a href="{{ route('comments.edit', [$post->slug, $comment->id]) }}"
            class="px-4 py-2 bg-blue-200 rounded-md">Edit
            Comment</a>
    </div>
    @endcan
</section>
@endsection

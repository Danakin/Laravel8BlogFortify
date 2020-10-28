@extends('layouts.app')

@section('content')
@include('posts.prism.header')
<section class="flex flex-col">
    <article class="mt-4">
        <h3 class="font-bold">{{ $post->title }}</h3>
        <p class="text-right">by {{ $post->user->name }}</p>
        <p>{!! $post->description !!}</p>
    </article>
    @can('update', $post)
    <div class="mt-4 text-right">
        <a href="{{ route('posts.edit', $post->slug) }}" class="px-4 py-2 bg-blue-200 rounded-md">Edit Post</a>
    </div>
    @endcan
</section>
<section class="mt-12 flex flex-col w-full divide-y divide-gray-400"">
    <div class=" flex flex-row justify-between items-center">
    <h3 class=" text-lg font-bold">Comments</h3>
    @can('create', 'App\\Models\Comment')
    <a href="{{ route('comments.create', ['post' => $post]) }}" class="px-4 py-2 bg-blue-200 rounded-md">New Comment</a>
    @endcan
    </div>
    @foreach ($post->comments->sortByDesc('id') as $comment)
    <article class="mt-4">
        <h3 class="font-bold">{{ $comment->title }}</h3>
        <p class="text-right">by {{ $comment->user->name }}</p>
        <p>{{ $comment->description }}</p>
        @can('update', $comment)
        <div class="w-full mt-2 text-right">
            <a href="{{ route('comments.edit', ['post' => $post, 'comment' => $comment]) }}"
                class="px-4 py-2 bg-blue-200 rounded-md">Edit Comment</a>

        </div>
        @endcan
    </article>
    @endforeach
</section>
@include('posts.prism.footer')
@endsection

@extends('layouts.app')

@section('content')
@include('posts.prism.header')
<section class="flex flex-col">
    <article class="mt-4">
        <h3 class="font-bold">{{ $post->title }}</h3>
        <p class="text-right">by {{ $post->user->name }}</p>
        <p>{!! $post->description !!}</p>
        @can('update', $post)
        <a href="{{ route('posts.edit', $post->slug) }}">Edit Post</a>
        @endcan
    </article>
</section>
@include('posts.prism.footer')
@endsection

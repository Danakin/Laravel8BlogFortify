@extends('layouts.app')

@section('content')
<form action="{{ route('register') }}" method="post" class="flex flex-wrap p-4 w-auto mx-auto border-gray-200">
    @csrf
    <x-input-text type="text" name="name">Name</x-input-text>
    <x-input-text type="email" name="email">Email</x-input-text>
    <x-input-text type="password" name="password">Password</x-input-text>
    <x-input-text type="password" name="password_confirmation">Confirm Password</x-input-text>
    <button type="submit">Submit!</button>
</form>
@endsection

@extends('layouts.app')

@section('content')

<form action="{{ route('login') }}" method="post" class="flex flex-wrap p-4 w-40 mx-auto border-gray-200">
    @csrf
    <label for="email" class="w-full sm:w-3/12">Email</label>
    <input type="email" name="email" id="email"
        class="w-full sm:w-9/12 p-2 border-2 border-gray-200 focus:border-blue-200">
    <label for="password" class="w-full sm:w-3/12">Password</label>
    <input type="password" name="password" id="password"
        class="w-full sm:w-9/12 p-2 border-2 border-gray-200 focus:border-blue-200">
    <button type="submit">Submit!</button>
</form>

@endsection

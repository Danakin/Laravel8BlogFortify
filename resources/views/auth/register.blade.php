@extends('layouts.app')

@section('content')
<form action="{{ route('register') }}" method="post" class="flex flex-wrap p-4 w-auto mx-auto border-gray-200">
    @csrf
    <label for="name" class="w-full sm:w-3/12">Name</label>
    <input type="text" name="name" id="name"
        class="w-full sm:w-9/12 p-2 border-2 border-gray-200 focus:border-blue-200">
    <label for="email" class="w-full sm:w-3/12">Email</label>
    <input type="email" name="email" id="email"
        class="w-full sm:w-9/12 p-2 border-2 border-gray-200 focus:border-blue-200">
    <label for="password" class="w-full sm:w-3/12">Password</label>
    <input type="password" name="password" id="password"
        class="w-full sm:w-9/12 p-2 border-2 border-gray-200 focus:border-blue-200">
    <label for="password_confirmation" class="w-full sm:w-3/12">Password</label>
    <input type="password" name="password_confirmation" id="password_confirmation"
        class="w-full sm:w-9/12 p-2 border-2 border-gray-200 focus:border-blue-200">
    <button type="submit">Submit!</button>
</form>
@endsection

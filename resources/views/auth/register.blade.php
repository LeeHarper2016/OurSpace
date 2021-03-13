@extends('layouts.app')
@section('content')
@include('errors.summary');
<div class="flex flex-col items-center mt-10">
    <img width="200" height="200" />
    <h1 class="text-4xl font-bold">Register</h1>
    <form method="post" action="{{ url('/users')  }}" class="flex flex-col mr-auto ml-auto space-y-5 mt-5">
        @csrf
        <div class="flex flex-col w-64">
            <label for="name">Name:</label>
            <input type="text" name="name" />
        </div>
        <div class="flex flex-col">
            <label for="name">Email:</label>
            <input type="email" name="email" />
        </div>
        <div class="flex flex-col">
            <label for="name">Password:</label>
            <input type="password" name="password" />
        </div>
        <div class="flex flex-col">
            <label for="name">Confirm Password:</label>
            <input type="password" name="passwordConfirm" />
        </div>
        <button type="submit" class="p-3 bg-gray-400 border border-black rounded w-20 ml-auto mr-auto">Submit</button>
    </form>
</div>
@endsection

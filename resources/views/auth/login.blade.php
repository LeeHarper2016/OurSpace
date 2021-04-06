@extends('layouts.app')
@section('content')
<div class="flex flex-col items-center mt-10">
    <img width="200" height="200" />
    <h1 class="text-4xl font-bold">Login</h1>
    <form method="post" action="{{ url('/users/login')  }}" class="flex flex-col mr-auto ml-auto space-y-5 mt-5">
        @csrf
        <div class="flex flex-col">
            <label for="email">Email:</label>
            <input type="email" name="email" value="{{ old('email') }}" />
        </div>
        <div class="flex flex-col">
            <label for="password">Password:</label>
            <input type="password" name="password" />
        </div>
        <button type="submit" class="p-3 bg-gray-400 border border-black rounded w-20 ml-auto mr-auto">Submit</button>
    </form>
</div>
@endsection

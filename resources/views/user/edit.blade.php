@extends('layouts.app')
@section('content')
    <div class="flex flex-col items-center mt-10">
        <img src="{{ asset($user->avatar) }}" width="200" height="200" />
        <h1 class="text-4xl font-bold">Account Details</h1>
        <form method="post" action="{{ route('user.edit')  }}" enctype="multipart/form-data"
              class="flex flex-col mr-auto ml-auto space-y-5 mt-5">
            @csrf
            <div class="flex flex-col">
                <label for="name">Username:</label>
                <input type="text" name="name" id="name" value="{{ $user->name }}" />
            </div>
            <div class="flex flex-col">
                <label for="email">Email:</label>
                <input type="text" name="email" id="email" value="{{ $user->email }}" />
            </div>
            <div class="flex flex-col">
                <label for="avatar">Avatar:</label>
                <input type="file" name="avatar" />
            </div>
            <div class="flex flex-col">
                <label for="password">Password:</label>
                <a href="#" class="mr-3 underline">Change Password</a>
            </div>
            <button type="submit" class="p-3 bg-gray-400 border border-black rounded w-20 ml-auto mr-auto">Submit</button>
        </form>
    </div>
@endsection

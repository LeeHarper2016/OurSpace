@extends('layouts.app')
@section('content')

    <div class="flex flex-wrap justify-center p-5">
        @foreach($spaces->all() as $space)
        <div class="block bg-indigo-300 w-52 h-52 m-5 border border-black rounded-md">
            <img src="{{ asset($space['banner_picture_path']) }}" class="w-full h-20 rounded-t-md" />
            <div class="p-5">
                <h1 class="break-words text-xl font-bold">{{ $space['name'] }}</h1>
                <p class="break-words">{{ $space['description'] }}</p>
            </div>
        </div>
        @endforeach
    </div>

@endsection

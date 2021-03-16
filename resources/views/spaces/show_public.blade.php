@extends('layouts.app')
@section('content')

    <div class="flex flex-wrap space-x-5 space-y-5">
        @foreach($spaces->all() as $space)
        <div class="block min-w-10 min-h-20">
            <img src="{{ asset($space['banner_picture_path'])  }}" />
            <h1>{{ $space['name'] }}</h1>
            <p>{{ $space['description'] }}</p>
        </div>
        @endforeach
    </div>

@endsection

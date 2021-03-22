@extends('layouts.app')
@section('content')
    @include('errors.summary')
    @include('particles.create')
    <div>
        @if (count($space->particles) < 1)
            <span>There appears to be no particles currently posted to this space.</span>
        @else
            @foreach($space->particles as $particle)
                <h1>{{ $particle->user->name }}</h1>
                <p>{{ $particle->body }}</p>
                <hr />
            @endforeach
        @endif
    </div>
@endsection

@extends('layouts.app')
@section('content')
    @include('errors.summary')
    @include('particles.create')
    <div>
        @if (count($space->particles) < 1)
            <span>There appears to be no particles currently posted to this space.</span>
        @else
            <particle-list particles='@json($space->particles)'></particle-list>
        @endif
    </div>
@endsection

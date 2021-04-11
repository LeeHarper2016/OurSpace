@extends('layouts.app')
@section('content')
    @include('errors.summary')
    <particle-form :space="{{ $space->id }}"></particle-form>
    <div>
        <particle-list :particles='@json($particles)'></particle-list>
    </div>
@endsection

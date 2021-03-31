@extends('layout')

@section('content')
    <h3>Content Page</h3>
    @foreach($data as $key => $value)
        {{ $key . '=' . $value }}
    @endforeach
@endsection

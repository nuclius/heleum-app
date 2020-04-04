@extends('layouts.error')

@section('title', 'Page Not Found')

@section('message')
    <p>{{ $exception->getMessage() }}</p>
@endsection

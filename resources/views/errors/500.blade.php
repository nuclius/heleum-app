@extends('layouts.error')

@section('title', 'Whoops, looks like something went wrong.')

@section('message')
    <p>We&rsquo;re working to correct the issue, <br>but if you need help please email our Awesome Support at support@heleum.com</p>

    <small>&hearts; Heleum</small>

    <!--
    IF ASKED, PLEASE COPY THE FOLLOWING MESSAGE INTO SUPPORT TICKET
    =================
    Line: {{ $exception->getLine() }}
    Message: {{ $exception->getMessage() }}
    =================
    -->
@endsection

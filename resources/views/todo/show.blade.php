@extends('layouts.app')
@section('title','View')
@section('content')
<div class="container">
    <h1 class="my-4 mx-4 text-4xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-6xl">{{$todo->title}}<h1>
        <p class="text-gray-900">
            @if ($todo->completed)
            <span class="bg-green-100 text-green-800 text-3xl font-medium m-5 px-2.5 py-0.5 rounded-full">Completed</span>
            @else
            <span class="bg-yellow-100 text-yellow-800 text-3xl font-medium m-5 px-2.5 py-0.5 rounded-full">Incomplete</span>
            @endif
        </p>
</div>
@endsection
@extends('layouts.app')
@section('title','EditTodo')
@section('content')
<div class="container">
    <h1 class="m-4 text-3xl font-bold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-6xl">Edit Todo</h1>
    @if($errors->any())
        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
            <ul>
                @foreach ($errors as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
          </div>
    @endif

    <form action="{{route('todo.update',$todo->id)}}" method="POST" class="mt-6 p-6">
        @csrf
        @method('PUT')
        <div class="mb-6">
          <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your password</label>
          <input type="text" name="title" id="title" value="{{$todo->title}}" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5" required>
        </div>
     
        <div class="flex items-start mb-6">
          <div class="flex items-center h-5">
            <input id="terms" name="completed" type="checkbox" value="1" {{$todo->completed ? 'checked' : ''}} class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300">
          </div>
          <label for="terms" class="ml-2 text-sm font-medium text-gray-900">Completed</label>
        </div>
        <button type="submit" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">Update</button>
      </form>
</div>
@endsection
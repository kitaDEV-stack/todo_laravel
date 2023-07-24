<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Models\User;
use Illuminate\Http\Request;


class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $todos=[];
        if(auth()->check()){
            $todos = auth()->user()->userTodo()->latest()->get();
        }
        return view('todo.index', compact('todos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('todo.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $newtodo = $request->validate([
            'title' => ['required','min:3'],
            'completed'=> 'nullable|boolean',
        ]);

        $newtodo['title'] = strip_tags($newtodo['title']);
        $newtodo['user_id'] = auth()->id();
        Todo::create($newtodo);
        return redirect()->route('todo.index')->with('success',"New todo add successfully.");
    }

    /**
     * Display the specified resource.
     */
    public function show(Todo $todo)
    {
       if(auth()->user()->id !== $todo['user_id']){
        return redirect('/');
       }
        return view('todo.show',compact('todo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Todo $todo)
    {
        if(auth()->user()->id !== $todo['user_id']){
            return redirect('/');
        }
        return view('todo.edit', compact('todo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Todo $todo)
    {
        if(auth()->user()->id !== $todo['user_id']){
            return redirect('/');
        }

        $inputs = $request->validate([
            'title' => ['required','min:3'],
            'completed'=> 'nullable|boolean',
        ]);

        $inputs['title'] = strip_tags($inputs['title']);
        $todo->update($inputs);
        return redirect()->route('todo.index')->with('success','Todo updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Todo $todo)
    {
        if(auth()->user()->id === $todo['user_id']){
            $todo->delete();
            return redirect()->route('todo.index')->with('success', 'Todo deleted successfully');
        }
        return redirect('/');
    }
}

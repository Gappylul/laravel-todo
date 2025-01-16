<?php

namespace App\Http\Controllers;

use App\Events\TodoCreated;
use App\Models\Todo;

class TodoController extends Controller
{
    public function index()
    {
        $todos = Todo::latest()->paginate(10);

        return view('todos.index', [
            'todos' => $todos
        ]);
    }

    public function create()
    {
        return view('todos.create');
    }

    public function store()
    {
        // Validation
        request()->validate([
            'title' => 'required|min:3',
            'description' => 'required|max:255|min:3',
        ]);

        $todo = Todo::create([
            'title' => request('title'),
            'description' => request('description'),
            'user_id' => auth()->id(),
        ]);

        // Dispatch the event
        event(new TodoCreated($todo));

        return redirect('/dashboard');
    }

    public function show($id)
    {
        $todo = Todo::findOrFail($id);

        return view('todos.show', [
            'todo' => $todo
        ]);
    }

    public function edit($id)
    {
        $todo = Todo::findOrFail($id);

        return view('todos.edit', [
            'todo' => $todo
        ]);
    }

    public function update($id)
    {
        $todo = Todo::findOrFail($id);

        // Validate
        request()->validate([
            'title' => 'required | min:3',
            'description' => 'required | max:255 | min:3',
        ]);

        // Update the job
        $todo->update([
            'title' => request('title'),
            'description' => request('description'),
        ]);

        // And persist
        // Redirect to the job page
        return redirect('/todos/' . $todo->id);
    }

    public function destroy($id)
    {
        $todo = Todo::findOrFail($id)->delete();

        return redirect('/todos/');
    }
}

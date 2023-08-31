<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Http\Requests\TasksRequest;

class TasksController extends Controller
{

    /**
     *
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::where('user_id', auth()->user()->id)->paginate();
        return view('tasks.index', ['tasks' => $tasks]);
    }


    /**
     *
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     *
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response Or Redirect
     */
    public function store(TasksRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->user()->id;
        
        Task::create($data);

        return redirect()->route('tasks.index')->with('message', 'Task has been added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task =  Task::where('user_id', auth()->user()->id)->findOrFail($id);

        return view('tasks.show', ['task' => $task]);
    }


    /**
     *
     * edit the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task =  Task::where('user_id', auth()->user()->id)->findOrFail($id);

        return view('tasks.edit', ['task' => $task]);
    }

    public function update(TasksRequest $request, $id)
    {
        // Check Record Exists
        $task =  Task::findOrFail($id);

        $task->update($request->validated());

        return redirect()->route('tasks.index')->with('message', 'Task updated successfully');
    }

    /**
     *
     * destroy a newly created resource in storage.
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tasks = Task::findOrFail($id);
        $tasks->delete();

        return redirect()->route('tasks.index')->with('message', 'Task deleted successfully');
    }

}

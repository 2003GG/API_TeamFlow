<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Requests\TaskRequest;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks=Task::with('project')->get();
        return response()->json([
            'status'=>'success',
            'data'=>$tasks,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskRequest $request)
    {
        $validate=$request->validated();
        $task=Task::create($validate);
        return response()->json([
            'status'=>'success',
            'message'=>'Task créée avec succès',
            'data'=>$task,
        ],201);


        $task=Task::create($validate);
        return response()->json([
            'status'=>'success',
            'message'=>'Task créée avec succès',
            'data'=>$task,
        ],201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        $task->load('project');
        return response()->json([
            'status'=>'success',
            'data'=>$task,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $validate=$request->validate([
            'title'=>'required|string|max:255',
            'description'=>'required|string',
            'status'=>'required|in:todo,in_progress,done',
        ]);
        $task->update($validate);
        return response()->json([
            'status'=>'success',
            'message'=>'Task mise à jour avec succès',
            'data'=>$task,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return response()->json([
            'status'=>'success',
            'message'=>'Task supprimée avec succès',
        ]);
    }
}

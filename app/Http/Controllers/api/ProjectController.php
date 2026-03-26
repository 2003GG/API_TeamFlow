<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
use App\Http\Requests\ProjectRequest;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects=Project::withCount('workspace','users','tasks');
        return response()->json([
            'status'=>'success',
            'data'=>$projects,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProjectRequest $request)
    {
        $validate=$request->validated();
        $project=Project::create($validate);
        return response()->json([
            'status'=>'success',
            'message'=>'Project créée avec succès',
            'data'=>$project,
        ],201);


    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        $project->load('workspace');
        return response()->json([
            'status'=>'Success',
            'data'=>$project,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,Project $project)
    {
        $validate=$request->validate([
            'title'=>'required|string|max:255',
            'description'=>'required|string',
        ]);
        $project->update($validate);
        return response()->json([
            'status'=>'success',
            'message'=>'Project mise à jour avec succès',
            'data'=>$project,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return response()->json([
            'status'=>'success',
            'message'=>'Project supprimée avec succès',
        ]);
    }
    public function addTask($id,ProjectRequest $request)
    {
        $validate=$request->validated();
        $project=Project::find($id);
        if($project){
        $task=$project->tasks()->create($validate);
        return response()->json([
            'status'=>'success',
            'message'=>'Task ajoutée au project avec succès',
            'data'=>$task,
        ],201);
        }
    }
    public function showTask($id){
        $project=Project::find($id);
        $task=$project->tasks();
        return response()->json([
            'status'=>'success',
            'data'=>$task
        ]);
    }
}



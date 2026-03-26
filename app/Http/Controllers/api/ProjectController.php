<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;

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
    public function store(Request $request)
    {
        $validate=$request->validate([
            'title'=>'required|string|max:255',
            'description'=>'required|string',
            'workspace_id'=>'required|integer|exists:workspaces,id',
        ]);
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
    // public function tasks(Project $project){

    //     $project->load('task');
    //     return response()->json([
    //         'status'=>'success',
    //         'data'=>$project,
    //     ]);

    // }
}

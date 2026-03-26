<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Workspace;
use Illuminate\Http\Request;
use App\Http\Requests\WorkspaceRequest;
class WorkspaceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $wokspaces=Workspace::withCount('projects')->get();
        return response()->json([
            'status'=>'success',
            'data'=>$wokspaces,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(WorkspaceRequest $request)
    {
        $validate=$request->validated();
        $workspace=Workspace::create($validate);
        return response()->json([
            'status'=>'success',
            'message'=>'Workspace créée avec succès',
            'data'=>$workspace,
        ],201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Workspace $workspace)
    {
        $workspace->load('projects');
        return response()->json([
            'status'=>'success',
            'data'=>$workspace,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(WorkspaceRequest $request, Workspace $workspace)
    {
        $validate=$request->validated();
        $workspace->update($validate);
        return response()->json([
            'status'=>'success',
            'message'=>'Workspace mise à jour avec succès',
            'data'=>$workspace,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Workspace $workspace)
    {
        $workspace->delete();
        return response()->json([
            'status'=>'success',
            'message'=>'Workspace supprimée avec succès',
        ]);
    }
}

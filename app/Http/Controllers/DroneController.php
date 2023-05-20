<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDroneRequest;
use App\Http\Resources\ShowDroneResource;
use App\Models\Drone;
use Illuminate\Http\Request;

class DroneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $drone = Drone::all();
        $drone = ShowDroneResource::collection($drone);
        return response()->json(['success'=>true, 'data'=>$drone], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDroneRequest $request)
    {
        $drone = Drone::store($request);
        return response()->json(['success'=>true, 'data'=>$drone], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $drone = Drone::find($id);
        $drone = new ShowDroneResource($drone);
        return response()->json(['success'=>true, 'data'=>$drone], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreDroneRequest $request, string $id)
    {
        $drone = Drone::find($id);
        $drone = Drone::store($request, $id);
        return response()->json(['success'=>true, 'data'=>$drone], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $drone = Drone::find($id);
        $drone->delete();
        return response()->json(['success'=>true, 'message'=>'deleted successfully'], 200);
    }
}

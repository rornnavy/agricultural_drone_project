<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDroneRequest;
use App\Http\Resources\ShowDroneResource;
use App\Models\Drone;
use App\Models\Instruction;
use App\Models\Location;
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
        $drone = Drone::where('drone_id', $id)->first();
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
    public function getCurrentLocation(string $id)
    {
        $drone = Drone::where('drone_id', $id)->first();
        if ($drone) {
            $locations = $drone->locations;
            $latestLocation = $locations->sortByDesc('created_at')->first();
            $currentLocation = [
                'latitude' => $latestLocation->latitude,
                'longitude' => $latestLocation->longitude,
            ];
            return response()->json(['success'=>true, 'data'=>$currentLocation], 200);
        } else {
            return response()->json(['success'=>false, 'message'=>'location not found'], 401);
        }
    }

    public function updateInstruction(string $id ,string $instruction)
    {
        $drone = Drone::where('drone_id', $id)->first();
        if($drone){
            $Instruction = Instruction::where('id', $instruction)->first();
            if($Instruction){
                $Instruction->update([
                    "name"=>request('name'),
                    "description"=>request('description'),
                ]);
            }
            return response()->json(['success'=>true, 'data'=>$Instruction], 200);
        }else{
            return response()->json(['success'=>false, 'data'=>"update is not success"], 200);
        }
    }
}

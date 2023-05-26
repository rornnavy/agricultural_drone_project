<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMapRequest;
use App\Http\Resources\ShowMapImageResource;
use App\Http\Resources\ShowMapResource;
use App\Models\Farm;
use App\Models\Map;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MapController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $map = Map::all();
        $map = ShowMapImageResource::collection($map);
        return response()->json(['success'=>true, 'data'=> $map], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMapRequest $request)
    {
        $map = Map::store($request);
        return response()->json(['success'=>true, 'data'=>$map], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $map = Map::find($id);
        $map = new ShowMapImageResource($map);
        return response()->json(['success'=>true, 'data'=>$map], 200);
    }
    public function showMapImage(string $id)
    {
        $map = Map::find($id);
        $map = new ShowMapImageResource($map);
        return response()->json(['success'=>true, 'data'=>$map], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreMapRequest $request, string $id)
    {
        $map = Map::find($id);
        $map  = Map::store($request, $id);
        return response()->json(['success'=>true, 'data'=>$map ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $map = Map::find($id);
        $map->delete();
        return response()->json(['success'=>true, 'message'=>'deleted successfully'], 200);
    }
    public function getImageOfFarm(string $name, string $farm_id)
    {
        $map = Map::where('name', $name)->first();
        if (!isset($map)) {
            return response()->json(['success' => false, 'message' => $name ], 401);
        }
        $farms = Farm::where('id', $farm_id)->first();
        if (empty($farms)) {
            return response()->json(['success' => false, 'message' => "farm id not found"], 401);
        }
        return response()->json(['success' => true, 'map_photo' =>$map->image], 200);

    }
    public function updateImageOfFarm(string $name, string $farm_id)
    {
        $farms = Farm::where('id', $farm_id)->first();
        if($farms){
            $map = Map::where('name', $name)->first();
            if($map){
                $map->update([
                    "image"=>request('image')
                ]);
                return response()->json(['success' => true, 'data' =>$map], 401);
            }
        }
    }
    public function deleteImageOfFarm(string $name, string $farm_id)
    {
        $map = Map::where('name', $name)->first();
        if (!isset($map)) {
            return response()->json(['success' => false, 'message' =>"don't have this name" ], 401);
        }
        $farms = Farm::where('id', $farm_id)->first();
        if (empty($farms)) {
            return response()->json(['success' => false, 'message' => "farm id not found"], 401);
        }

        if($map->image){
            $map->image ="null";
            $map->save(); 
        }
        
        return response()->json(['success' => true, 'map_photo' =>"deleted successfully"], 200);
    }
}

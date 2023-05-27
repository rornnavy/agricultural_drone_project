<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLocationRequest;
use App\Http\Resources\ShowLocationResource;
use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $location = Location::all();
        $location = ShowLocationResource::collection($location);
        return response()->json(['success' => true, 'data' => $location],201);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLocationRequest $request)
    {
        $location = Location::store($request);
        return response()->json(['success' => true, 'data' => $location],200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $location = Location::find($id);
        $location = new ShowLocationResource($location);
        return response()->json(['success' => true, 'data' =>$location],200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreLocationRequest $request, string $id)
    {
        $location = Location::store($request, $id);
        return response()->json(['success' => true, 'data' =>$location],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $location = Location::find($id);
        $location->delete();
        return response()->json(['success' => true, 'data' =>$location],200);
    }
}

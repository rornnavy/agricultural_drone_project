<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFieldRequest;
use App\Http\Resources\ShowFieldResource;
use App\Models\Field;
use Illuminate\Http\Request;

class FieldController extends Controller
{
    public function index()
    {
        $field = Field::all();
        $field = ShowFieldResource::collection($field);
        return response()->json(['success'=>true, 'data'=>$field], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFieldRequest $request)
    {
        $field = Field::store($request);
        return response()->json(['success'=>true, 'data'=>$field], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $field = Field::find($id);
        $field = new ShowFieldResource($field);
        return response()->json(['success'=>true, 'data'=>$field], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreFieldRequest $request, $id)
    {
        $field = Field::find($id);
        $field = Field::store($request, $id);
        return response()->json(['success'=>true, 'data'=>$field], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $field = Field::find($id);
        $field->delete();
        return response()->json(['success'=>true, 'message'=>'deleted successfully'], 200);
    }
}
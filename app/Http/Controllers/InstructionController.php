<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInstructionRequest;
use App\Http\Resources\ShowInstructionResurce;
use App\Models\Instruction;
use Illuminate\Http\Request;

class InstructionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $instruction = Instruction::all();
        $instruction = ShowInstructionResurce::collection($instruction);
        return response()->json(['success'=>true, 'data'=> $instruction], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInstructionRequest $request)
    {
        $instruction = Instruction::store($request);
        return response()->json(['success'=>true, 'data'=>$instruction], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $instruction = Instruction::find($id);
        $instruction = new ShowInstructionResurce($instruction);
        return response()->json(['success'=>true, 'data'=>$instruction], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreInstructionRequest $request, string $id)
    {
        $instruction = Instruction::find($id);
        $instruction  = Instruction::store($request, $id);
        return response()->json(['success'=>true, 'data'=>$instruction ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $instructure = Instruction::find($id);
        $instructure->delete();
        return response()->json(['success'=>true, 'message'=>'deleted successfully'], 200);
    }
}

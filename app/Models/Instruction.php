<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Instruction extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
    ];
    public static function store($request, $id = null)
    {
        $instruction = $request->only(
            'name',
            'description',
        );
        $instruction = self::updateOrCreate(['id' => $id], $instruction);

        return $instruction;
    }
}

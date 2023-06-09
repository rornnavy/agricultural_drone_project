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
        'drone_id',
    ];
    public static function store($request, $id = null)
    {
        $instruction = $request->only(
            'name',
            'description',
            'drone_id',
        );
        $instruction = self::updateOrCreate(['id' => $id], $instruction);

        return $instruction;
    }
    public function drone(): BelongsTo
    {
        return $this->belongsTo(Drone::class);
    }
}

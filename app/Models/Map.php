<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Map extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'image',
        'drone_id',
    ];

    public function drone(): BelongsTo
    {
        return $this->belongsTo(Drone::class, 'drone_id', 'id');
    }
    // public function field(): BelongsTo
    // {
    //     return $this->belongsTo(Field::class, 'field_id', 'id');
    // }
    public static function store($request, $id = null)
    {
        $map = $request->only(
            'name',
            'image',
            'drone_id',
        );
        $map = self::updateOrCreate(['id' => $id], $map);

        return $map;
    }
}

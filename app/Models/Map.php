<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Map extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'image',
        'drone_id',
    ];
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

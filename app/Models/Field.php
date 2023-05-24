<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Field extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'location_id',
    ];
    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class, 'location_id', 'id');
    }
    public function map(): HasOne
    {
        return $this->hasOne(Map::class, 'map_id', 'id');
    }

    public static function store($request,$id = null)
    {
        //request values
        $fields = $request->only([ 
            'name',
            'description',
            'location_id'
        ]);
        $field = self::updateOrCreate(['id'=> $id], $fields);
        return $field;
    }

}

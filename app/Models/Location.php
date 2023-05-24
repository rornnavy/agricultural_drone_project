<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'longitude',
        'latitude',
        'drone_id',
    ];
    public function field(): HasOne
    {
        return $this->hasOne(Field::class, 'Field_id', 'id');
    }
    public function drone(): BelongsTo
    {
        return $this->belongsTo(Drone::class, 'drone_id', 'id');
    }

    public static function store($request,$id = null)
    {
        //request values
        $locations = $request->only([ 
            'name',
            'longitude',
            'latitude',
            'drone_id'
        ]);
        $location = self::updateOrCreate(['id'=> $id], $locations);
        return $location;
    }

}



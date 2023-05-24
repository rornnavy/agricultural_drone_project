<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Drone extends Model
{
    use HasFactory;
    protected $fillable = [
        'type',
        'battery',
        'date_time',
        'area',
        'spray_density',
        'user_id',
    ];
    public function plans()
    {
        return $this->belongsToMany(Plan::class, 'drone_plans')->withTimestamps();
    }
    public function maps():HasMany
    {
        return $this->hasMany(Map::class, 'map_id','id');
    }
    public static function store($request, $id = null)
    {
        $drone = $request->only(
            'type',
            'battery',
            'date_time',
            'area',
            'spray_density',
            'user_id',
        );
        $drone = self::updateOrCreate(['id' => $id], $drone);

        $drones = request('plans');
        $drone->plans()->sync($drones);

        return $drone;
    }
    public function user():BelongsTo{
        
        return $this->belongsTo(User::class);
    }
    public function locations():HasMany{
        
        return $this->hasMany(Location::class);
    }
}

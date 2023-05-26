<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Drone extends Model
{
    use HasFactory;
    protected $fillable = [
        'drone_id',
        'type',
        'battery',
        'date_time',
        'area',
        'spray_density',
        'user_id',
    ];
    
    public static function store($request, $id = null)
    {
        $drone = $request->only(
            'drone_id',
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
    public function instructions():HasMany{
        
        return $this->hasMany(Instruction::class);
    }
    public function maps():HasMany
    {
        return $this->hasMany(Map::class);
    }
    public function plans()
    {
        return $this->belongsToMany(Plan::class, 'drone_plans')->withTimestamps();
    }
    
}
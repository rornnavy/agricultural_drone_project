<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Plan extends Model
{
    use HasFactory;
    protected $fillable = [
        'plan_name',
        'start_time',
        'end_time',
        'task',
        'description',
        'user_id',
    ];
    public static function store($request, $id = null)
    {
        $plan = $request->only(
            'plan_name',
            'start_time',
            'end_time',
            'task',
            'description',
            'user_id',
        );
        $plan = self::updateOrCreate(['id' => $id], $plan);

        return $plan;
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function drones()
    {
        return $this->belongsToMany(Drone::class, 'drone_plans')->withTimestamps();
    }
    public function farms()
    {
        return $this->belongsToMany(Farm::class, 'farm_plans')->withTimestamps();
    }
}

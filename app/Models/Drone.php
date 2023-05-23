<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
}

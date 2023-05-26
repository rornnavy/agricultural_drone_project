<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Farm extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'name',
        'description',
    ];
    public static function store($request, $id = null)
    {
        $farm = $request->only(
            'id',
            'name',
            'description',
        );
        $farm = self::updateOrCreate(['id' => $id], $farm);

        $farms = request('plans');
        $farm->plans()->sync($farms);
        return $farm;
    }
    public function maps():HasMany
    {
        return $this->hasMany(Map::class);
    }
    public function plans()
    {
        return $this->belongsToMany(Plan::class, 'farm_plans')->withTimestamps();
    }
    
}

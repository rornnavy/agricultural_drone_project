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
        'date_time',
        'user_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public static function store($request,$id = null)
    {
        //request values
        $ticket = $request->only([ 'plan_name','date_time','user_id']);
        $ticket = self::updateOrCreate(['id'=> $id], $ticket);
        return $ticket;
    }
}

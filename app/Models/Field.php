<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'location_id',
    ];


    public static function store($request,$id = null)
    {
        //request values
        $field = $request->only([ 'name','description','location_id']);
        $field = self::updateOrCreate(['id'=> $id], $field);
        return $field;
    }

}

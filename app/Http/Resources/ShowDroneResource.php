<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShowDroneResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'type'=>$this->type,
            'battery'=>$this->battery,
            'date_time'=>$this->date_time,
            'area'=>$this->area,
            'spray_density'=>$this->spray_density,
            'user_id'=>$this->user,
        ];
    
    }
}

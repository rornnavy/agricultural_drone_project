<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShowPlanResource extends JsonResource
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
            'plan_name'=>$this->plan_name,
            'start_time'=>$this->start_time,
            'end_time'=>$this->end_time,
            'task'=>$this->task,
            'description'=>$this->description,
            'user_id'=>$this->user,
            'drones'=>ShowDroneResource::collection($this->drones),
        ];
    }
}

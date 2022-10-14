<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class TicketResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'category' => $this->category->category,
            'priority' => $this->priority->priority_level,
            'status' => optional($this->status)->status,
            'title'=> $this->title,
            'description' => $this->description,
            'assign_to' => User::where('id',$this->assign_user_id)->value('name'),
        ];
    }
}

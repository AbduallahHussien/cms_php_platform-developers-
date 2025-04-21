<?php

namespace Botble\CustomerTickets\Http\Resources;


use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Log;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        Log::info("this",$this);
        Log::info("request",$request);
        return [

            'id'         => $this->id,
            'text'       => $this->text,
            'created_at' => $this->created_at->format('Y-m-d H:i'),
        ];
    }

}

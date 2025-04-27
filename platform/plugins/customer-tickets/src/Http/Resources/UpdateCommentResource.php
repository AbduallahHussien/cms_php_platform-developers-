<?php

namespace Botble\CustomerTickets\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UpdateCommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        return [
            'id'         => $this->id,
            'text'       => $this->text,
            'created_at' => $this->updated_at->format('Y-m-d H:i'),
        ];
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReportResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'title' => $this->title,
            'author' => $this->user->getFullName(),
            'description' => $this->description,
            'image' => $this->image?->getUrl(),
        ];
    }
}

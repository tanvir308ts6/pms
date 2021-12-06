<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{

    public function toArray($request): array
    {
        return [
            'name' => $this->getFullName(),
            'role' => $this->role->name,
            'email' => $this->email,
            'nickname' => $this->username,
            'birthdate' => $this->birthdate,
            'phone_number' => $this->phone_number,
            'home_phone_number' => $this->home_phone_number,
            'address' => $this->address,
        ];
    }
}

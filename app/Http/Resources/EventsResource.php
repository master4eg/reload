<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EventsResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */

    public function toArray($request)
    {

        return [
            'id' => $this->id,
            'date' => $this->date,
            'phone' => $this->phone,
            'firstName' => $this->firstName,
            'secondName' => $this->secondName,
            'middleName' => $this->middleName,
            'start' => $this->date
        ];
    }

}

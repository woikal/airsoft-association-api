<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class ClubResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'name'         => $this->name,
            'abbreviation' => $this->abbreviation,
            'zvr'          => $this->zvr,
            'location'     => $this->location,
            'founded'      => $this->founded_at,
            'province'     => [
                'id'   => $this->province->id,
                'name' => $this->province->name,
            ],
            'website'      => $this->website,
            'facebook'     => $this->facebook,
            'instagram'    => $this->instagram,
            'email'        => $this->email,
            'status'       => $this->checked_by ? 'checked' : 'pending',
        ];
    }
}

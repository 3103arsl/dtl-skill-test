<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'name' => $this->name,
            'price' => $this->price,
            'creator' => ($this->creator) ? $this->creator->name : null,
            'type' => ['id' => $this->type, 'label' => $this->getTypeLabel()],
            'status' => ['id' => $this->status, 'label' => $this->getStatusLabel()],
            'logs' => $this->logs->map(function ($user) {
                return collect($user->toArray())
                    ->only(['properties'])
                    ->all();
            })
        ];
    }

    public function with($request)
    {
        return [
            'success' => true
        ];
    }
}

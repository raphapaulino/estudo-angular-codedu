<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductCategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'product' => new ProductResource($this->resource), // é passado o model de produto para o ProductResource (ver o __construct da classe JsonResource)
            'categories' => CategoryResource::collection($this->resource->categories)
        ];
    }
}
